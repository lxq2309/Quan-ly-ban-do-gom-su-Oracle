<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Employee;
use App\Models\admin\Job;
use App\Models\admin\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = Employee::query();
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $users->where('PhoneNumber', 'LIKE', "%$searchText%");
        }




        $users = $users->paginate();
        return view('admin.employee.index', compact('users'))
            ->with('i', ($users->currentPage() - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new Employee();
        $jobs = Job::all();
        return view('admin.employee.create', compact('user', 'jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Employee::$rules);

        $user = Employee::create($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Employee::find($id);

        return view('admin.employee.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Employee::find($id);

        return view('admin.employee.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\admin\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $user)
    {
        request()->validate(Employee::$rules);

        $user->update($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = Employee::find($id)->delete();

        return redirect()->route('employee.index')
            ->with('success', 'User deleted successfully');
    }

    function getAll()
    {
        return response()->json(Employee::all());
    }
}
