@extends('Layout')
   
@section('main')

<div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">

      <div class="col-lg">
        <div class="card">
          <div class="card-body">
                <h5 class="card-title text-center">Company Details Update Form</h5>
                <!-- Your form goes here -->
                <form action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data" method="post" class="row g-3">

                    @csrf
                    @method('put')
                    
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"  value="{{ $company->name }}">
                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>
            
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"  value="{{ $company->email }}">
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
            
                    <div class="col-12">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                        <span class="text-danger">@error('logo') {{ $message }} @enderror</span>
                    </div>
            
                    <div class="col-12">
                        <label for="link" class="form-label">Website Link</label>
                        <input type="text" class="form-control" name="link" id="link"  value="{{ $company->link }}">
                    </div>
            
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </section>

  @endsection






    