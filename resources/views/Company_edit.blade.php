@extends('Layout')

@section('main')

<section class="section">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Company Details Update Form</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">

                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach

                    </div>
                    @endif

                    <form action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data"
                        method="post" class="row g-3" id="myForm">
                        @csrf
                        @method('put')

                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}">
                            {{-- <span id="name_error" class="text-danger">@error('name') {{ $message }}
                                @enderror</span> --}}
                            <span id="nameError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $company->email }}">
                            {{-- <span id="email_error" class="text-danger">@error('email') {{ $message }}
                                @enderror</span> --}}
                            <span id="emailError" class="error text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                            <span id="logoError" class="text-danger"></span>
                        </div>

                        <div class="col-12">
                            <label for="link" class="form-label">Website Link</label>
                            <input type="text" class="form-control" name="link" id="link" value="{{ $company->link }}">
                            <span id="websiteError" class="text-danger"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
            var websiteError = document.getElementById("websiteError");

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

            if (logo){
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
                var urlRegex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,3}?(\/.*)?$/;
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
@endsection
