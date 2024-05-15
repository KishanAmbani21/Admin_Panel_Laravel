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
                <div class="card" style="margin-top: -100px;">
                    <div class="card-body">
                        
                        <h5 class="card-title text-center">Add Company Details Form</h5>

                        @if ($errors->any())
                        <div class="alert alert-danger">

                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach

                        </div>
                        @endif

                        <form action="{{ route('company.store') }}" enctype="multipart/form-data" method="post"
                            class="row g-3" id="myForm">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                <span id="nameError" class="error text-danger"></span>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}">
                                <span id="emailError" class="error text-danger"></span>
                            </div>
                            <div class="col-12">
                                <label for="logo" class="form-label">Logo (minimum size 100×100)</label>
                                <input type="file" class="form-control" name="logo" id="logo" value="{{ old('logo') }}">
                                <span id="logoError" class="error text-danger"></span>
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

    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var form = document.getElementById("myForm");

        form.addEventListener("submit", function(event) {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var logo = document.getElementById("logo").value;

            var nameError = document.getElementById("nameError");
            var emailError = document.getElementById("emailError");
            var logoError = document.getElementById("logoError");

            nameError.textContent = "";
            emailError.textContent = "";
            logoError.textContent = "";

            if (name === "") {
                nameError.textContent = "Company Name is required";
                event.preventDefault();
            }else if (name.length < 3) {
                    document.getElementById('nameError').textContent = 'Company Name minimum of 3 characters';
            }

            if (email === "") {
                emailError.textContent = "Company Email is required";
                event.preventDefault();
            } else if (!isValidEmail(email)) {
                emailError.textContent = "Please enter a valid email address";
                event.preventDefault();
            }

            if (logo === "") {
                logoError.textContent = "Company Logo is required";
                event.preventDefault();
            }

            function isValidEmail(email) {
                var emailRegex = /\S+@\S+\.\S+/;
                return emailRegex.test(email);
            }
        });
    });
    </script>

</body>

</html>