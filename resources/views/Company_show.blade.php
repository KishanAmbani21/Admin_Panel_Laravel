@extends('Layout')

@section('main')
<!-- Title -->
<div class="pagetitle">
  <h1>Company Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company</a></li>
      <li class="breadcrumb-item active">Show</li>
    </ol>
  </nav>
</div>

<!-- Company Profile -->
<section class="section profile">
  <div class="row">
    <!-- Company Details Card -->
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card p-5 d-flex flex-column align-items-center">
          <img src="{{ asset('storage/logo/' . $company->logo) }}" alt="Profile" width="150px" height="150px">
          <h2>{{ $company->name }}</h2>
        </div>
      </div>
    </div>

    <!-- Company Information -->
    <div class="col-xl-8">
      <div class="card">
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title text-center">Company Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Company Id:</div>
                <div class="col-lg-9 col-md-8">{{ $company->id }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Company Name:</div>
                <div class="col-lg-9 col-md-8">{{ $company->name }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Company Email:</div>
                <div class="col-lg-9 col-md-8">{{ $company->email }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Website Link:</div>
                <div class="col-lg-9 col-md-8">{{ $company->link }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Address:</div>
                <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Employee List -->
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Employee List</h5>

          @if(session('delete'))
            <div class="alert alert-success">{{ session('delete') }}</div>
          @endif

          @if($employees->isEmpty())
            <p class="text-center">Employees Not available.</p>
          @else
            <!-- Employee Table -->
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Company</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th>Action1</th>
                  <th>Action2</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employees as $employee)
                  <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->company->name ?? '' }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td><a class="btn btn-warning" href="{{ route('employee.show', $employee->id) }}">Show</a></td>
                    <td>
                      <form action="{{ route('employee.destroy', $employee->id) }}" method="post" id="deleteform{{ $employee->id }}">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete?')){event.preventDefault();document.getElementById('deleteform{{ $employee->id }}').submit()}">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="d-flex justify-content-center">
              {!! $employees->links() !!}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
