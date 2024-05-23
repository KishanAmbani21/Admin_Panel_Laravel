@extends('Layout')

@section('main')
<section class="section">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Company Details Update Form</h5>

                    <!-- Display validation errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <!-- Update form -->
                    <form action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data" method="post" class="row g-3" id="myForm">
                        @csrf
                        @method('put')

                        <!-- Name input -->
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}">
                            <span id="nameError" class="error text-danger"></span>
                        </div>

                        <!-- Email input -->
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $company->email }}">
                            <span id="emailError" class="error text-danger"></span>
                        </div>

                        <!-- Logo input -->
                        <div class="col-12">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                            <span id="logoError" class="text-danger"></span>
                        </div>

                        <!-- Website link input -->
                        <div class="col-12">
                            <label for="link" class="form-label">Website Link</label>
                            <input type="text" class="form-control" name="link" id="link" value="{{ $company->link }}">
                            <span id="websiteError" class="text-danger"></span>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- Custom JS File -->
<script src="{{ asset('assets/js/company_edit.js') }}"></script>
