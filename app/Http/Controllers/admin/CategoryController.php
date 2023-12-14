<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Lọc các danh mục có danh mục con hoặc là danh mục root
        $categoryHasChildIds = array();
        foreach(Category::all() as $category)
        {
            if($category->childcategories->count() > 0 || $category->parentid == null)
            {
                $categoryHasChildIds[] = $category->categoryid;
            }
        }

        // sắp xếp và phân trang
        $categories = Category::whereIn('categoryid', $categoryHasChildIds)->orderBy('categoryid', 'desc')->paginate(10);
        return view('admin.category.index', compact('categories'))
            ->with('i', ($categories->currentPage() - 1) * $categories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $parentCategories = Category::all();

        return view('admin.category.create', compact('category', 'parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Category::$rules);

        $category = Category::create($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $genres = $category->genres;

        return view('admin.category.show', compact('category', 'genres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parentCategories = Category::all();

        return view('admin.category.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\admin\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        request()->validate(Category::$rules);

        $category->update($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }

    function getAll(){
        return response()->json(Category::all());
    }
}
