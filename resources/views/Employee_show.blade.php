@extends('Layout')

@section('main')

<div class="pagetitle">
  <h1>Employee Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card p-5 d-flex flex-column align-items-center">
          <img src="{{ asset('assets/img/Kishan.jpg') }}" alt="Profile" width="150px" height="150px">
          <h2>{{ $employee->first_name . ' ' . $employee->last_name}}</h2>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
      <div class="card">
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane fade show active profile-overview" id="profile-overview" style="margin-bottom: -11px;">
              <h5 class="card-title text-center">Employee Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Employee Id :</div>
                <div class="col-lg-9 col-md-8">{{ $employee->id }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">First Name :</div>
                <div class="col-lg-9 col-md-8">{{ $employee->first_name }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Last Name :</div>
                <div class="col-lg-9 col-md-8">{{ $employee->last_name }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Employee Email :</div>
                <div class="col-lg-9 col-md-8">{{ $employee->email }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Employee Phone :</div>
                <div class="col-lg-9 col-md-8">{{ $employee->phone }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

@endsection
