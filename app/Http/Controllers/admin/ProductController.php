<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Category;
use App\Models\admin\Color;
use App\Models\admin\Country;
use App\Models\admin\Product;
use App\Models\admin\Glaze;
use App\Models\admin\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query();
        if ($request->has('search'))
        {
            $searchText = $request->input('search');
            $products->where('productname', 'LIKE', "%$searchText%");
        }
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        if (empty($request->input('order')))
        {
            $orderBy = 'desc';
        }
        $products->orderBy('ProductID', $orderBy);
        $orderBy = ($request->has('order') && $request->input('order') == 'asc') ? 'desc' : 'asc';
        $products = $products->paginate()->appends(['order' => $orderBy]);
        return view('admin.product.index', compact('products'))
            ->with('i', ($products->currentPage() - 1) * $products->perPage());
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $images = $product->productimages;
        $countries = Country::all();
        $colors = Color::all();;
        $glazes = Glaze::all();
        $categories = Category::all();
        $sizes = Size::all();


        return view('admin.product.create', compact('product', 'images', 'countries', 'colors', 'glazes', 'categories', 'sizes'));
    }

    /**
     * Create the specified resource in storage.
     * (Ta truyền vào ProductID, sau đó nhờ cơ chế Route Model Binding của Laravel mà nó tự binding sang bản ghi Product tương ứng)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\admin\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Product::$rules);

        // lấy dữ liệu từ các thẻ input
        $input = $request->all();

        // Xử lý lưu tệp tải lên
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/product'), $imageName);
            $input['image'] = '/images/product/' . $imageName;
        } else {
            if ($input['imageurl']) {
                $input['image'] = $input['imageurl'];
            } else {
                $input['image'] = '/images/product/default.png';
            }
        }

        // Thêm sản phẩm mới
        $product = Product::create($input);

        // Thêm các hình ảnh mới vào
        $newProductImages = [];
        $randomNumber = time();
        $newImagesUrl = $request->input('images-url', []);
        //  Thêm từ url
        if ($newImagesUrl) {
            foreach ($newImagesUrl as $imageUrl) {
                if (!empty($imageUrl)) {
                    $newProductImages[] = [
                        'imagepath' => $imageUrl
                    ];
                }
            }
        }
        // Thêm từ file
        if ($request->hasFile('images-file')) {
            $newImagesFile = $request['images-file'];
            foreach ($newImagesFile as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/product/images'), $imageName);
                $imagePath = '/images/product/images/' . $imageName;
                $newProductImages[] = [
                    'imagepath' => $imagePath
                ];
            }
        }
        $product->productimages()->createMany($newProductImages);

        return redirect()->route('product.show', $product->productid)
            ->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $images = $product->productimages;

        return view('admin.product.show', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $images = $product->productimages;
        $countries = Country::all();
        $colors = Color::all();;
        $glazes = Glaze::all();
        $categories = Category::all();
        $sizes = Size::all();

        return view('admin.product.edit', compact('product', 'images', 'countries', 'colors', 'glazes', 'categories', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     * (Ta truyền vào ProductID, sau đó nhờ cơ chế Route Model Binding của Laravel mà nó tự binding sang bản ghi Product tương ứng)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\admin\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate(Product::$rules);

        // lấy dữ liệu từ các thẻ input
        $input = $request->all();

        // Xử lý lưu tệp tải lên
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/product'), $imageName);
            $input['image'] = '/images/product/' . $imageName;
        } else {
            if ($input['imageurl']) {
                $input['image'] = $input['imageurl'];
            } else {
                $input['image'] = '/images/product/default.png';
            }
        }

        // cập nhật dữ liệu của sản phẩm
        $product->update($input);

        // Xoá các hình ảnh đã chọn
        $selectedImageIds = $request->input('imagesids', []);
        $imagesToDelete = $product->productimages->whereNotIn('imageid', $selectedImageIds);
        foreach ($imagesToDelete as $image) {
            $image->delete();
        }
        // Thêm các hình ảnh mới vào
        $newProductImages = [];
        $randomNumber = time();
        $newImagesUrl = $request->input('images-url', []);
        //  Thêm từ url
        if ($newImagesUrl) {
            foreach ($newImagesUrl as $imageUrl) {
                if (!empty($imageUrl)) {
                    $newProductImages[] = [
                        'imagepath' => $imageUrl
                    ];
                }
            }
        }
        // Thêm từ file
        if ($request->hasFile('images-file')) {
            $newImagesFile = $request['images-file'];
            foreach ($newImagesFile as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/product/images'), $imageName);
                $imagePath = '/images/product/images/' . $imageName;
                $newProductImages[] = [
                    'imagepath' => $imagePath
                ];
            }
        }
        $product->productimages()->createMany($newProductImages);

        return redirect()->route('product.show', $product->productid)
            ->with('success', 'Sửa thông tin thành công!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $title = $product->productname;
        $product->deleted = 1;
        $product->save();

        return redirect()->route('product.index')
            ->with('success', "Xoá thành công sản phẩm $title với mã sản phẩm là $id");
    }

    /**
     * api search Product
     */
    public function searchProduct($searchText)
    {
        $products = Product::where('productname', 'LIKE', "%$searchText%")
            ->get();
        return response()->json($products);
    }

    /**
     * api get Product by id
     */
    public function getById($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * api get all
     */
    public function getAll()
    {
        $products = Product::all();
        return response()->json($products);
    }
}
