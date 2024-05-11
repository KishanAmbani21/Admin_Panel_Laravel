<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $search = $request->input('search');

        // $employee = $search ? employee::where('name', 'like', '%' . $search . '%')->get() : Employee::all();

       // $employee = Employee::all();
        // return view('Employee_dashboard', compact('employee', 'search'));
   

        if($request->ajax()){
            $employee = Employee::all();
        
        return DataTables::of($employee)
    ->addColumn('action1', function($employee) {
        return '<button type="button" class="btn btn-warning" onclick="window.location.href=\'' . route('employee.show', $employee->id) . '\'">Show</button>';
    })
    ->addColumn('action2', function($employee) {
        return '<button type="button" class="btn btn-primary" onclick="window.location.href=\'' . route('employee.edit', $employee->id) . '\'">Edit</button>';
    })
    ->addColumn('action3', function($employee) {
        $route = route('employee.destroy', $employee->id);
        return '<button class="btn btn-danger" onclick="document.getElementById(\'deleteform\').action=\'' . $route . '\'; document.getElementById(\'deleteform\').submit();">Delete</button>';
    })
    ->rawColumns(['action1','action2','action3'])
    ->make(true);
        }
        return view('Employee_dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->has('id')){
            $company=Company::find($request->id);
            return view('Employee_add',compact('company'));
        }
       
        $company=Company::all();
        return view('Employee_add',compact('company'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:25'],
            'phone' => ['required', 'string', 'max:10'],
        ]);
    
        // Create a new user instance
        $employee = new Employee();
        $employee->first_name = $request['first_name'];
        $employee->last_name = $request['last_name'];
        $employee->email = $request['email'];
        $employee->phone = $request['phone'];
        $employee->company_id = $request['company'];

        $employee->save();
        
        return redirect()->route('employee.index')->with('success', 'employee added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        
        return view('Employee_show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = employee::findOrFail($id);
        return view('Employee_edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = employee::findOrFail($id);

        $request->validate([
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:25'],
            'phone' => ['nullable', 'max:10']
        ]);

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;

        $employee->update();
        
        return redirect()->route('employee.index')->with('success', 'employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $emp=Employee::findorfail($id);
        $emp->delete();
        return redirect()->back()->with('success', 'employee deleted successfully');
    }
}
