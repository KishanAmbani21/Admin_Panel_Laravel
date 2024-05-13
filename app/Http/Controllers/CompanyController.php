<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyMail;
use App\Models\Company;
use App\Models\Employee;

class CompanyController extends Controller
{
    /**
     * Display a listing of the trashed companies.
     *
     * @return \Illuminate\View\View
     */
    public function traceData()
    {
        // Get all trashed companies
        $company = Company::onlyTrashed()->get();
        
        // Return view with trashed companies data
        return view('Company_trace', compact('company'));
    }

    /**
     * Display a listing of the companies with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get search term from request
        $search = $request->input('search');
        
        // Start building the query for companies
        $query = Company::query();

        // Apply search filter if search term exists
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Paginate the results with 10 items per page
        $companies = $query->paginate(10);
        
        // Return view with paginated companies data
        return view('Company_dashboard', compact('companies', 'search'));
    }

    /**
     * Show the form for creating a new company.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return view for creating a new company
        return view('Company_add');
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:50'],
            'logo' => ['required', 'mimes:jpeg,png,jpg,pdf,docx,doc,txt', 'dimensions:min_width=100,min_height=100']
        ]);

        // Create a new company instance
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->link = $request->link;

        // Upload and store company logo
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $request->file('logo')->storeAs('public', $filename);
            $imageUrl = Storage::url($imagePath);
            $company->logo = $imageUrl;
        }

        // Save the company
        $company->save();

        // Send email notification
        $mailData = [
            'title' => $request->name,
            'body' => $company->logo,
        ];
        Mail::to($request->email)->send(new CompanyMail($mailData));

        // Redirect back with success message
        return redirect()->route('company.index')->with('success', 'Company added successfully');
    }

    

}





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

    // Initialize the query
    $query = Company::query();

    // Apply search filter if provided
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');

    }

    // Paginate the results with 10 items per page
    $companies = $query->paginate(2);

    // Pass the results and search term to the view
    return view('Company_dashboard', compact('companies', 'search'));
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

    /**
     * Display the specified company.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);
        
        // Get employees associated with the company
        $employee = Employee::where('company_id', $id)->get();
        
        // Return view with company and employee data
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
        // Find the company by ID
        $company = Company::findOrFail($id);
        
        // Return view for editing the company
        return view('Company_edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find the company by ID
        $company = Company::findOrFail($id);

        // Validate incoming request data
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'logo' => ['nullable', 'mimes:jpeg,png,jpg,pdf,docx,doc,txt', 'dimensions:min_width=100,min_height=100']
        ]);

        // Update company details
        $company->name = $request->name;
        $company->email = $request->email;
        $company->link = $request->link;

        // Update company logo if provided
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $request->file('logo')->storeAs('public', $filename);
            $imageUrl = Storage::url($imagePath);
            $company->logo = $imageUrl;
        }

        // Save the updated company
        $company->update();

        // Redirect back with success message
        return redirect()->route('company.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Delete company by ID
        Company::destroy($id);

        // Redirect back with success message
        return redirect()->back()->with('delete', 'Company deleted successfully');
    }

    /**
     * Restore the specified soft deleted company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        // Find the soft deleted company by ID
        $company = Company::withTrashed()->find($id);

        // If company exists
        if ($company) {
            // Restore the company
            $company->restore();
            // Redirect back with success message
            return redirect()->back()->with('success', 'Company restored successfully.');
        } else {
            // Redirect back with error message if company not found
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
        // Find the soft deleted company by ID
        $company = Company::withTrashed()->find($id);

        // If company exists
        if ($company) {
            // Permanently delete the company
            $company->forceDelete();
            // Redirect back with success message
            return redirect()->back()->with('success', 'Company permanently deleted.');
        } else {
            // Redirect back with error message if company not found
            return redirect()->back()->with('error', 'Company not found.');
        }
    }
}
