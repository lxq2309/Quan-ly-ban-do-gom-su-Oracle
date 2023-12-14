<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = Job::query();
        if ($request->has('search'))
        {
            $searchText = $request->input('search');
            $jobs->where('JobName', 'LIKE', "%$searchText%");
        }

        $jobs = $jobs->paginate();
        return view('admin.job.index', compact('jobs'))
            ->with('i', ($jobs->currentPage() - 1) * $jobs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job = new Job();
        return view('admin.job.create', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Job::$rules);

        $job = Job::create($request->all());

        return redirect()->route('job.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);

        return view('admin.job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);

        return view('admin.job.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\admin\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        request()->validate(Job::$rules);


        $job->update($request->all());

        return redirect()->route('job.index')
            ->with('success', 'Job updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $job = Job::find($id)->delete();

        return redirect()->route('job.index')
            ->with('success', 'Job deleted successfully');
    }

    function getAll(){
        return response()->json(Job::all());
    }
}
