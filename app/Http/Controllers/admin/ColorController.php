<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colors = Color::query();
        if ($request->has('search'))
        {
            $searchText = $request->input('search');
            $colors->where('ColorName', 'LIKE', "%$searchText%");
        }

        $colors = $colors->paginate();
        return view('admin.color.index', compact('colors'))
            ->with('i', ($colors->currentPage() - 1) * $colors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $color = new Color();
        return view('admin.color.create', compact('color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Color::$rules);

        $color = Color::create($request->all());

        return redirect()->route('color.index')
            ->with('success', 'Color created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $color = Color::find($id);

        return view('admin.color.show', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);

        return view('admin.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\admin\Color $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        request()->validate(Color::$rules);


        $color->update($request->all());

        return redirect()->route('color.index')
            ->with('success', 'Color updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $color = Color::find($id)->delete();

        return redirect()->route('color.index')
            ->with('success', 'Color deleted successfully');
    }

    function getAll(){
        return response()->json(Color::all());
    }
}
