<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Edit</title>
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
    </main>

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
    
                var isValid = true;
    
                if (firstname === "") {
                    firstnameError.textContent = "Employee FirstName is required";
                    isValid = false;
                } else if (firstname.length < 3) {
                    firstnameError.textContent = "Employee FirstName must be at least 3 characters long";
                    isValid = false;
                }
    
                if (lastname === "") {
                    lastnameError.textContent = "Employee LastName is required";
                    isValid = false;
                } else if (lastname.length < 3) {
                    lastnameError.textContent = "Employee LastName must be at least 3 characters long";
                    isValid = false;
                }
    
                if (email === "") {
                    emailError.textContent = "Company Email is required";
                    isValid = false;
                } else {
                    var emailRegex = /^[a-z]+[a-z0-9]+@(gmail|mail|outlook|hotmail)\.(com|in|org)$/;
                    if (!emailRegex.test(email)) {
                        emailError.textContent = "Please enter a valid email address";
                        isValid = false;
                    }
                }
    
                if (phone === "") {
                    phoneError.textContent = "Phone Number is required";
                    isValid = false;
                } else if (!isValidPhoneNumber(phone)) {
                    phoneError.textContent = "Please enter a valid 10-digit phone number";
                    isValid = false;
                }
    
                if (!isValid) {
                    event.preventDefault();
                }
            });
    
            function isValidPhoneNumber(phone) {
                var phoneRegex = /^\d{10}$/;
                return phoneRegex.test(phone);
            }
        });
    </script>

</body>

</html>
