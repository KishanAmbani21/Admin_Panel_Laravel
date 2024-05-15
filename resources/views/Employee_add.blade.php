<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    @include('Layout')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg">
                    <div class="card" style="margin-top: -100px">
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
                                    <input type="text" class="form-control" name="first_name" id="firstname"
                                        value="{{ old('first_name') }}">
                                    <span id="firstnameError" class="error text-danger"></span>
                                </div>

                                <div class="col-12">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="lastname"
                                        value="{{ old('last_name') }}">
                                    <span id="lastnameError" class="error text-danger"></span>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}">
                                    <span id="emailError" class="error text-danger"></span>
                                </div>

                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" name="phone" id="phone"
                                        value="{{ old('phone') }}">
                                    <span id="phoneError" class="error text-danger"></span>
                                </div>

                                @if(isset($company->id))
                                <div class="form-group">
                                    <label>Company</label>

                                    @if (request('id'))
                                    <select name="company" class="form-select" id="company">
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    </select>
                                    @endif

                                </div>
                                @else

                                <div class="form-group">
                                    <label>Company</label>
                                    <select name="company" class="form-select" id="company">
                                        <option selected>Company default</option>
                                        @foreach($company as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("myForm");
    
            form.addEventListener("submit", function(event) {
                var firstname = document.getElementById("firstname").value;
                var lastname = document.getElementById("lastname").value;
                var email = document.getElementById("email").value;
                var phone = document.getElementById("phone").value;
                
                var firstnameError = document.getElementById("firstnameError");
                var lastnameError = document.getElementById("lastnameError");
                var emailError = document.getElementById("emailError");
                var phoneError = document.getElementById("phoneError");

                firstnameError.textContent = "";
                lastnameError.textContent = "";
                emailError.textContent = "";
                phoneError.textContent = "";
                
                if (firstname === "") {
                    firstnameError.textContent = "Employee FirstName is required";
                    event.preventDefault();
                }else if (firstname.length < 3) {
                    document.getElementById('firstnameError').textContent = 'Employee FirstName minimum of 3 characters';
                }

                if (lastname === "") {
                    lastnameError.textContent = "Employee LastName is required";
                    event.preventDefault();
                }else if (lastname.length < 3) {
                    document.getElementById('lastnameError').textContent = 'Employee LastName minimum of 3 characters';
                }

                if (email === "") {
                    emailError.textContent = "Email is required";
                    event.preventDefault();
                } else if (!isValidEmail(email)) {
                    emailError.textContent = "Please enter a valid email address";
                    event.preventDefault();
                }
    
                if (phone === "") {
                    phoneError.textContent = "Phone Number is required";
                    event.preventDefault();
                }else if (!isValidPhoneNumber(phone)) {
                    phoneError.textContent = "Please enter a valid 10-digit phone number";
                    event.preventDefault();
                }

                function isValidEmail(email) {
                    var emailRegex = /\S+@\S+\.\S+/;
                    return emailRegex.test(email);
                }

                function isValidPhoneNumber(phone) {
                    var phoneRegex = /^\d{10}$/;
                    return phoneRegex.test(phone);
                }
            });
        });
    </script>
</body>

</html>