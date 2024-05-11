<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyMail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function dashboard()
    // {
    //     return view('company_dashboard');
    // }
    public function trace_data()
    {

        $company = Company::onlyTrashed()->get();
        return view('Company_trace', compact('company'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $company = $search ? Company::where('name', 'like', '%' . $search . '%')->get() : Company::all();

        return view('Company_dashboard', compact('company', 'search'));
    }

    public function create()
    {
        return view('Company_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:50'],
            'logo' => ['required', 'mimes:jpeg,png,jpg,pdf,docx,doc,txt', 'dimensions:min_width=100,min_height=100']
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->link = $request->link;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $request->file('logo')->storeAs('public', $filename);
            $imageUrl = Storage::url($imagePath);
            $company->logo = $imageUrl;
        }


        $company->save();

        $maildata = [
            'title' => $request->name,
            'body' => $company->logo,
        ];

        Mail::to($request->email)->send(new CompanyMail($maildata));

        return redirect()->route('company.index')->with('success', 'Company added successfully');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        $employee = Employee::where('company_id', $id)->get();
        return view('Company_show', compact('company', 'employee'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('Company_edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'logo' => ['nullable', 'mimes:jpeg,png,jpg,pdf,docx,doc,txt', 'dimensions:min_width=100,min_height=100']
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->link = $request->link;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $request->file('logo')->storeAs('public', $filename);
            $imageUrl = Storage::url($imagePath);
            $company->logo = $imageUrl;
        }

        $company->update();

        return redirect()->route('company.index')->with('success', 'Company updated successfully');
    }

    public function destroy($id)
    {
        Company::destroy($id);

        return redirect()->back()->with('success', 'Company deleted successfully');
    }

    public function restore($id)
    {
        $company = Company::withTrashed()->find($id);

        if ($company) {
            $company->restore();
            return redirect()->back()->with('success', 'Company permanently deleted.');
        } else {
            return redirect()->back()->with('error', 'Company not found.');
        }
    }

    public function delete($id)
    {
        $company = Company::withTrashed()->find($id);

        if ($company) {
            $company->forceDelete();
            return redirect()->back()->with('success', 'Company permanently deleted.');
        } else {
            return redirect()->back()->with('error', 'Company not found.');
        }
    }
}
