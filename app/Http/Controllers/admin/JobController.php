<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countrys = Country::query();
        if ($request->has('search'))
        {
            $searchText = $request->input('search');
            $countrys->where('CountryName', 'LIKE', "%$searchText%");
        }

        $countrys = $countrys->paginate();
        return view('admin.country.index', compact('countrys'))
            ->with('i', ($countrys->currentPage() - 1) * $countrys->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = new Country();
        return view('admin.country.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Country::$rules);

        $country = Country::create($request->all());

        return redirect()->route('country.index')
            ->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);

        return view('admin.country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);

        return view('admin.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\admin\Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        request()->validate(Country::$rules);


        $country->update($request->all());

        return redirect()->route('country.index')
            ->with('success', 'Country updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $country = Country::find($id)->delete();

        return redirect()->route('country.index')
            ->with('success', 'Country deleted successfully');
    }

    function getAll(){
        return response()->json(Country::all());
    }
}
