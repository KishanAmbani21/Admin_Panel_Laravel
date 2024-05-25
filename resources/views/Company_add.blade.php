@extends('Layout')

@section('main')
    <!-- ======= Add Company Details  ======= -->
    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- Title -->
                    <h5 class="card-title text-center">Add Company Details Form</h5>

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif

                    <!-- Form to Add Company Details -->
                    <form action="{{ route('company.store') }}" enctype="multipart/form-data" method="post" class="row g-3" id="myForm">
                        @csrf
                        <!-- Name Input -->
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            <span id="nameError" class="error text-danger"></span>
                        </div>

                        <!-- Email Input -->
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            <span id="emailError" class="error text-danger"></span>
                        </div>

                        <!-- Logo Input -->
                        <div class="col-12">
                            <label for="logo" class="form-label">Logo (minimum size 100×100)</label>
                            <input type="file" class="form-control" name="logo" id="logo" accept=".jpeg, .jpg, .png">
                            <span id="logoError" class="error text-danger"></span>
                            @if($errors->has('logo'))
                            <div class="alert text-danger">
                                {{ $errors->first('logo') }}
                            </div>
                            @endif
                        </div>

                        <!-- Website Link Input -->
                        <div class="col-12">
                            <label for="link" class="form-label">Website Link</label>
                            <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}">
                            <span id="websiteerror" class="text-danger"></span>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Add Company Details Section -->
@endsection


<!-- Custom JS File -->
<script src="{{ asset('assets/js/company_add.js') }}"></script>
