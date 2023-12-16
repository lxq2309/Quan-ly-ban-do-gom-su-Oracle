<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Publisher;
use App\Models\admin\PurchaseOrder;
use App\Models\admin\PurchaseOrderDetail;
use App\Models\admin\Supplier;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class PurchaseOrderController
 * @package App\Http\Controllers
 */
class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchaseOrders = PurchaseOrder::query();
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $purchaseOrders->where('orderid', '=', $searchText);
        }
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        if (empty($request->input('order'))) {
            $orderBy = 'desc';
        }
        $purchaseOrders->orderBy('orderid', $orderBy);
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        $purchaseOrders = $purchaseOrders->paginate()->appends(['order' => $orderBy]);
        return view('admin.purchase-order.index', compact('purchaseOrders'))
            ->with('i', ($purchaseOrders->currentPage() - 1) * $purchaseOrders->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchaseOrder = new PurchaseOrder();
        $suppliers = Supplier::all();
        $purchaseOrder->orderdate = now(); // or use \Carbon\Carbon::now() if not already imported
        return view('admin.purchase-order.create', compact('purchaseOrder', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Tạo hoá đơn nhập

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->orderdate = Carbon::parse($request->input('orderdate'))->format('Y-m-d H:i:s');
        $purchaseOrder->supplierid = $request->input('supplierid');
        $purchaseOrder->employeeid = $request->input('employeeid');
        $purchaseOrder->save();
        $totalPrice = 0;

        // Lấy dữ liệu chi tiết sản phẩm từ form
        $productIDs = $request->input('ProductID');
        $quantities = $request->input('Quantity');
        $prices = $request->input('Price');

        // Lưu chi tiết hoá đơn
        foreach ($productIDs as $key => $productID) {
            $purchaseOrderDetail = new PurchaseOrderDetail();
            $purchaseOrderDetail->orderid = $purchaseOrder->orderid;
            $purchaseOrderDetail->productid = $productID;
            $purchaseOrderDetail->quantity = $quantities[$key];
            $purchaseOrderDetail->price = $prices[$key];
            $subTotal = $quantities[$key] * $prices[$key];
            $purchaseOrderDetail->totalamount = $subTotal;
            $purchaseOrderDetail->save();

            $totalPrice += $subTotal;
        }

        $purchaseOrder->totalamount = $totalPrice;
        $purchaseOrder->save();


        return redirect()->route('purchase-order.show', $purchaseOrder->orderid)
            ->with('success', 'Tạo hoá đơn thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $purchaseOrderDetails = $purchaseOrder->purchaseorderdetail;

        return view('admin.purchase-order.show', compact('purchaseOrder', 'purchaseOrderDetails'));
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $purchaseOrder->deleted = 1;
        $purchaseOrder->save();

        return redirect()->route('purchase-order.index')
            ->with('success', 'Xoá hoá đơn thành công');
    }
}
