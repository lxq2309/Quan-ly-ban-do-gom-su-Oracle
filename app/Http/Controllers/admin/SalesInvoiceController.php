<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Customer;
use App\Models\admin\SalesInvoice;
use App\Models\admin\InvoiceDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class SalesInvoiceController
 * @package App\Http\Controllers
 */
class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salesInvoices = SalesInvoice::query();
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $salesInvoices->where('invoiceid', '=', $searchText);
        }
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        if (empty($request->input('order'))) {
            $orderBy = 'desc';
        }
        $salesInvoices->orderBy('invoiceid', $orderBy);
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        $salesInvoices = $salesInvoices->paginate()->appends(['order' => $orderBy]);
        return view('admin.sales-invoice.index', compact('salesInvoices'))
            ->with('i', ($salesInvoices->currentPage() - 1) * $salesInvoices->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salesInvoice = new SalesInvoice();
        $customers = Customer::all();
        return view('admin.sales-invoice.create', compact('salesInvoice', 'customers'));
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

        $salesInvoice = new SalesInvoice();
        $salesInvoice->saledate = Carbon::parse($request->input('saledate'))->format('Y-m-d H:i:s');
        $salesInvoice->customerid = $request->input('customerid');
        $salesInvoice->employeeid = $request->input('employeeid');
        $salesInvoice->save();
        $totalPrice = 0;

        // Lấy dữ liệu chi tiết sản phẩm từ form
        $productIDs = $request->input('ProductID');
        $quantities = $request->input('Quantity');
        $prices = $request->input('Price');

        // Lưu chi tiết hoá đơn
        foreach ($productIDs as $key => $productID) {
            $InvoiceDetail = new InvoiceDetail();
            $InvoiceDetail->invoiceid = $salesInvoice->invoiceid;
            $InvoiceDetail->productid = $productID;
            $InvoiceDetail->quantity = $quantities[$key];
            $InvoiceDetail->price = $prices[$key];
            $subTotal = $quantities[$key] * $prices[$key];
            $InvoiceDetail->totalamount = $subTotal;
            $InvoiceDetail->save();

            $totalPrice += $subTotal;
        }

        $salesInvoice->totalamount = $totalPrice;
        $salesInvoice->save();

        return redirect()->route('sales-invoice.show', $salesInvoice->invoiceid)
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
        $salesInvoice = SalesInvoice::find($id);
        $salesInvoiceDetails = $salesInvoice->salesinvoicedetail;

        return view('admin.sales-invoice.show', compact('salesInvoice', 'salesInvoiceDetails'));
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salesInvoice = SalesInvoice::find($id);
        $salesInvoice->deleted = 1;
        $salesInvoice->save();

        return redirect()->route('sales-invoice.index')
            ->with('success', 'Xoá hoá đơn thành công');
    }
}
