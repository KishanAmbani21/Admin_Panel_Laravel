@extends('Layout')

@section('main')
<section class="section">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    @if($errors->has('email'))
                    <div class="alert alert-danger" style="margin-bottom: 0px; margin-top: 24px;">
                        {{ implode('<br>', $errors->get('email')) }}
                    </div>
                    @endif

                    <h5 class="card-title text-center">Add Employee Details Form</h5>

                    <form action="{{ route('employee.store') }}" enctype="multipart/form-data" method="post" class="row g-3" id="myForm">
                        @csrf
                        @method('post')

                        <div class="col-12">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="firstname" value="{{ old('first_name') }}">
                            <span id="firstnameError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="lastname" value="{{ old('last_name') }}">
                            <span id="lastnameError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            <span id="emailError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                            <span id="phoneError" class="error text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="company">Company</label>
                            <select name="company" class="form-select" id="company">
                                @if(isset($company->id) && request('id'))
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @else
                                <option selected>Company default</option>
                                @foreach($company as $companyItem)
                                <option value="{{ $companyItem->id }}">{{ $companyItem->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JS File -->
<script src="{{ asset('assets/js/employee_add.js') }}"></script>
