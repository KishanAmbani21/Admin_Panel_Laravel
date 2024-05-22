<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
// use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Employee::query();
    
            return DataTables::eloquent($query)
                ->addColumn('action1', function ($employee) {
                    return '<button type="button" class="btn btn-warning" onclick="window.location.href=\'' . route('employee.show', $employee->id) . '\'">Show</button>';
                })
                ->addColumn('action2', function ($employee) {
                    return '<button type="button" class="btn btn-success" onclick="window.location.href=\'' . route('employee.edit', $employee->id) . '\'">Edit</button>';
                })
                ->addColumn('action3', function ($employee) {
                    $route = route('employee.destroy', $employee->id);
                    return '<button class="btn btn-danger" onclick="if(confirm(\'Are you sure you want to delete?\')){event.preventDefault();document.getElementById(\'deleteform\').action=\'' . $route . '\'; document.getElementById(\'deleteform\').submit();}">Delete</button>';
                })
                ->rawColumns(['action1', 'action2', 'action3'])
                ->make(true);
        }
        return view('Employee_dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->has('id')) {
            $company = Company::find($request->id);
            return view('Employee_add', compact('company'));
        }

        $company = Company::all();
        return view('Employee_add', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => ['required', 'string', 'min:3'],
                'last_name' => ['required', 'string', 'min:3'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'max:10'],
            ]);

            $employee = new Employee();
            $employee->first_name = $request['first_name'];
            $employee->last_name = $request['last_name'];
            $employee->email = $request['email'];
            $employee->phone = $request['phone'];
            $employee->company_id = $request['company'];

            $employee->save();

            return redirect()->route('employee.index')->with('success', 'Employee added successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'The Email has already been taken',
                    'phone' => 'The Phone has already been taken'
                ]);
            }
            return redirect()->back()->withInput()->withErrors(['unexpected_error' => 'An unexpected error occurred.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        $company = Company::findOrFail($id);

        return view('Employee_show', compact('employee', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('Employee_edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeRequest $request, string $id)
    {
        try {

            $validate = $request->validated();
            $employee = Employee::findOrFail($id);

            $employee->update($validate);

            return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'The Email has already been taken',
                    'phone' => 'The Phone has already been taken'
                ]);
            }
            return redirect()->back()->withInput()->withErrors(['unexpected_error' => 'An unexpected error occurred.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $emp = Employee::findOrFail($id);
        $emp->delete();
        return redirect()->back()->with('delete', 'Employee deleted successfully');
    }
}
