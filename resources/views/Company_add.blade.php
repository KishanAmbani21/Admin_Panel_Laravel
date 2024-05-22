<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Add</title>
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
                                <input type="file" class="form-control" name="logo" id="logo"
                                    accept=".jpeg, .jpg, .png">
                                <span id="logoError" class="error text-danger"></span>
                                @if($errors->has('logo'))
                                <div class="alert text-danger">
                                    {{ $errors->first('logo') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-12">
                                <label for="link" class="form-label">Website Link</label>
                                <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}">
                                <span id="website_error" class="text-danger"></span>
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
                var logo = document.getElementById("logo").files[0];
                var website = document.getElementById("link").value;
    
                var nameError = document.getElementById("nameError");
                var emailError = document.getElementById("emailError");
                var logoError = document.getElementById("logoError");
                var websiteError = document.getElementById("website_error");
    
                nameError.textContent = "";
                emailError.textContent = "";
                logoError.textContent = "";
                websiteError.textContent = "";
    
                var isValid = true;
    
                if (name === "") {
                    nameError.textContent = "Company Name is required";
                    isValid = false;
                } else if (name.length < 3) {
                    document.getElementById('nameError').textContent = 'Company Name minimum of 3 characters';
                    isValid = false;
                }
    
                if (email === "") {
                    emailError.textContent = "Company Email is required";
                    isValid = false;
                } else {
                    var emailRegex = /^[a-z]+[a-z0-9]+@[a-z]+\.(com|in|org|net)$/;
                    if (!emailRegex.test(email)) {
                        emailError.textContent = "Please enter a valid email address";
                        isValid = false;
                    }
                }
    
                if (!logo) {
                logoError.textContent = "Please upload a logo";
                isValid = false;
            } else {
                var validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(logo.type)) {
                    logoError.textContent = "Please upload a JPEG, JPG, or PNG image";
                    isValid = false;
                } else {
                    var img = new Image();
                    img.src = URL.createObjectURL(logo);
                    img.onload = function() {
                        if (img.width < 100 || img.height < 100) {
                            logoError.textContent = "Minimum logo size is 100x100";
                            isValid = false;
                        }
                    };
                    img.onerror = function() {
                        logoError.textContent = "Error loading the image";
                        isValid = false;
                    };
                }
            }
    
                if (website.trim() === "") {
                    websiteError.textContent = "Please enter Website";
                    isValid = false;
                } else {
                    var urlRegex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}?(\/.*)?$/;
                    if (!urlRegex.test(website)) {
                        websiteError.textContent = "Please enter a valid URL";
                        isValid = false;
                    }
                }
    
                if (!isValid) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });
        });
    </script>

</body>

</html>
