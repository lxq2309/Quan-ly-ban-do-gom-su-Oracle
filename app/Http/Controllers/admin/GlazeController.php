<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Glaze;
use Illuminate\Http\Request;

class GlazeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $glazes = Glaze::query();
        if ($request->has('search'))
        {
            $searchText = $request->input('search');
            $glazes->where('GlazeName', 'LIKE', "%$searchText%");
        }

        $glazes = $glazes->paginate();
        return view('admin.glaze.index', compact('glazes'))
            ->with('i', ($glazes->currentPage() - 1) * $glazes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $glaze = new Glaze();
        return view('admin.glaze.create', compact('glaze'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Glaze::$rules);

        $glaze = Glaze::create($request->all());

        return redirect()->route('glaze.index')
            ->with('success', 'Glaze created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $glaze = Glaze::find($id);

        return view('admin.glaze.show', compact('glaze'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $glaze = Glaze::find($id);

        return view('admin.glaze.edit', compact('glaze'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\admin\Glaze $glaze
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Glaze $glaze)
    {
        request()->validate(Glaze::$rules);


        $glaze->update($request->all());

        return redirect()->route('glaze.index')
            ->with('success', 'Glaze updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $glaze = Glaze::find($id)->delete();

        return redirect()->route('glaze.index')
            ->with('success', 'Glaze deleted successfully');
    }

    function getAll(){
        return response()->json(Glaze::all());
    }
}
