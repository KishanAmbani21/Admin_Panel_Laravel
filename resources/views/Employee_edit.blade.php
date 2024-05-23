@extends('Layout')

@section('main')
<section class="section">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Employee Details Update Form</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data"
                        method="post" class="row g-3" id="myForm">
                        @csrf
                        @method('put')

                        <div class="col-12">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="firstname"
                                value="{{ $employee->first_name }}">
                            <span id="firstnameError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="lastname"
                                value="{{ $employee->last_name }}">
                            <span id="lastnameError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $employee->email }}">
                            <span id="emailError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" name="phone" id="phone"
                                value="{{ $employee->phone }}">
                            <span id="phoneError" class="error text-danger"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- Custom JS File -->
<script src="{{ asset('assets/js/employee_edit.js') }}"></script>
