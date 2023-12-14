<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Productset;
use App\Models\admin\ProductsetDetail;
use Illuminate\Http\Request;

/**
 * Class ProductsetController
 * @package App\Http\Controllers
 */
class ProductsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productsets = Productset::query();
        if ($request->has('search'))
        {
            $searchText = $request->input('search');
            $productsets->where('SetName', 'LIKE', "%$searchText%");
        }
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        if (empty($request->input('order')))
        {
            $orderBy = 'desc';
        }
        $productsets->orderBy('SetID', $orderBy);
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        $productsets = $productsets->paginate()->appends(['order' => $orderBy]);
        return view('admin.productset.index', compact('productsets'))
            ->with('i', ($productsets->currentPage() - 1) * $productsets->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productset = new Productset();
        return view('admin.productset.create', compact('productset'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Productset::$rules);

        $input = $request->all();

        // Xử lý lưu tệp tải lên
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/productset'), $imageName);
            $input['image'] = '/images/productset/' . $imageName;
        } else {
            if ($input['imageurl']) {
                $input['image'] = $input['imageurl'];
            } else {
                $input['image'] = '/images/productset/default.jpg';
            }
        }

        $productset = Productset::create($input);

        // Lấy dữ liệu chi tiết
        $productIDs = $request->input('ProductID');
        $quantities = $request->input('Quantity');

        // Lưu chi tiết
        foreach ($productIDs as $key => $productID) {
            $setDetail = new ProductsetDetail();
            $setDetail->setid = $productset->setid;
            $setDetail->productid = $productID;
            $setDetail->quantity = $quantities[$key];
            $setDetail->save();
        }
        $productset->save();

        return redirect()->route('productset.show', $productset->setid)
            ->with('success', 'Tạo bộ sản phẩm thành công!');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productset = Productset::find($id);
        $productsetdetails = $productset->productsetdetail;

        return view('admin.productset.show', compact('productset', 'productsetdetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productset = Productset::find($id);

        return view('admin.productset.edit', compact('productset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Productset $productset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productset $productset)
    {
        request()->validate(Productset::$rules);

        $input = $request->all();

        // Xử lý lưu tệp tải lên
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/productset'), $imageName);
            $input['image'] = '/images/productset/' . $imageName;
        } else {
            if ($input['imageurl']) {
                $input['image'] = $input['imageurl'];
            } else {
                $input['image'] = '/images/productset/default.jpg';
            }
        }

        $productset->update($input);


        // Lấy dữ liệu chi tiết bộ
        $productIDs = $request->input('ProductID');
        $quantities = $request->input('Quantity');

        // Xoá các chi tiết bộ đã tồn tại
        ProductsetDetail::where('setid', $productset->setid)->delete();

        // Lưu chi tiết bộ mới
        foreach ($productIDs as $key => $productID) {
            $setDetail = new ProductsetDetail();
            $setDetail->setid = $productset->setid;
            $setDetail->productid = $productID;
            $setDetail->quantity = $quantities[$key];
            $setDetail->save();
        }
        $productset->save();

        return redirect()->route('productset.show', $productset->setid)
            ->with('success', 'Sửa bộ sản phẩm thành công!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        // Xoá các chi tiết bộ đã tồn tại
        ProductsetDetail::where('setid', $id)->delete();
        $productset = Productset::find($id)->delete();

        return redirect()->route('productset.index')
            ->with('success', 'Xoá thành công');
    }

    function getAll(){
        return response()->json(Productset::all());
    }
}
