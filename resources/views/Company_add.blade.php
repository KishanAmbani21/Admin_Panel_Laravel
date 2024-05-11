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

        <div class="card">
            <div class="card-body">

                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <h5 class="card-title text-center">Add Company Details Form</h5>

                <!-- Your form goes here -->
                <form id="companyForm" action="{{ route('company.store') }}" enctype="multipart/form-data" method="post"
                    class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-12">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" id="logo" value="{{ old('logo') }}">
                        <span class="text-danger">@error('logo') {{ $message }} @enderror</span>

                    </div>
                    <div class="col-12">
                        <label for="link" class="form-label">Website Link</label>
                        <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </div>

    </div>
</section>

{{-- ghasgxj --}}

@endsection