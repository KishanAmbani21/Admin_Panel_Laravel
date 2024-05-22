<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyMail;
use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Company::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $companies = $query->paginate(10);

        return view('Company_dashboard', compact('companies', 'search'));
    }

    /**
     * Show the form for creating a new company.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Company_add');
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email'],
                // 'logo' => ['required', 'mimes:jpeg,png,jpg', 'dimensions:min_width=100,min_height=100'],
                'link' => ['url'],
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

            $mailData = [
                'title' => $request->name,
                'body' => $company->logo,
            ];
            Mail::to($request->email)->send(new CompanyMail($mailData));

            return redirect()->route('company.index')->with('success', 'Company added successfully');
        } catch (QueryException $e) {

            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Company already exists',
                ]);
            }

            return redirect()->back()->withInput()->withErrors(['unexpected_error' => 'An unexpected error occurred.']);
        }
    }

    /**
     * Display the specified company.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        $employee = Employee::where('company_id', $id)->get();

        return view('Company_show', compact('company', 'employee'));
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('Company_edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyRequest $request, $id)
    {
        try {
            $validate = $request->validated();
            $company = Company::findOrFail($id);

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $imagePath = $request->file('logo')->storeAs('public', $filename);
                $imageUrl = Storage::url($imagePath);
                $company->logo = $imageUrl;
            }

            $company->update($validate);

            return redirect()->route('company.index')->with('success', 'Company updated successfully');
        } catch (QueryException $e) {

            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Company already exists',
                ]);
            }

            return redirect()->back()->withInput()->withErrors(['unexpected_error' => 'An unexpected error occurred.']);
        }
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Company::destroy($id);

        return redirect()->back()->with('delete', 'Company traced successfully');
    }

    /**
     * Restore the specified soft deleted company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $company = Company::withTrashed()->find($id);

        if ($company) {

            $company->restore();

            $company->employees()->withTrashed()->restore();

            return redirect()->back()->with('success', 'Company restored successfully.');
        } else {
            return redirect()->back()->with('error', 'Company not found.');
        }
    }

    /**
     * Permanently delete the specified company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $company = Company::withTrashed()->find($id);

        if ($company) {

            $company->forceDelete();

            return redirect()->back()->with('delete', 'Company permanently deleted.');
        } else {

            return redirect()->back()->with('error', 'Company not found.');
        }
    }

    /**
     * Display a listing of the trashed companies.
     *
     * @return \Illuminate\View\View
     */
    public function traceData()
    {
        $company = Company::onlyTrashed()->get();

        return view('Company_trace', compact('company'));
    }
}
