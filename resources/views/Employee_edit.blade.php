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

                            <form action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data" method="post" class="row g-3" onsubmit="return validateForm()">
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
        function validateForm() {
            var firstName = document.getElementById("firstname").value;
            var lastName = document.getElementById("lastname").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;

            var firstNameError = document.getElementById("firstnameError");
            var lastNameError = document.getElementById("lastnameError");
            var emailError = document.getElementById("emailError");
            var phoneError = document.getElementById("phoneError");

            firstNameError.textContent = "";
            lastNameError.textContent = "";
            emailError.textContent = "";
            phoneError.textContent = "";

            var isValid = true;

            if (firstName.trim() === "") {
                firstNameError.textContent = "Please enter First Name";
                isValid = false;
            }

            if (lastName.trim() === "") {
                lastNameError.textContent = "Please enter Last Name";
                isValid = false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.trim() !== "" && !emailRegex.test(email)) {
                emailError.textContent = "Please enter a valid email address";
                isValid = false;
            } else if (email.trim() === "") {
                emailError.textContent = "Please enter an email address";
                isValid = false;
            }

            var phoneRegex = /^\d{10}$/;
            if (phone.trim() !== "" && !phoneRegex.test(phone)) {
                phoneError.textContent = "Please enter a valid 10-digit phone number";
                isValid = false;
            } else if (phone.trim() === "") {
                phoneError.textContent = "Please enter a phone number";
                isValid = false;
            }

            return isValid;
        }
    </script>

</body>

</html>
