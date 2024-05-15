@extends('Layout')

@section('main')

<section class="section">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Company Details Update Form</h5>

                    <form action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data"
                        method="post" class="row g-3" onsubmit="return validateForm()">
                        @csrf
                        @method('put')

                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}">
                            <span id="name_error" class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $company->email }}">
                            <span id="email_error" class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-12">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                            <span id="logo_error" class="text-danger">@error('logo') {{ $message }} @enderror</span>
                        </div>

                        <div class="col-12">
                            <label for="link" class="form-label">Website Link</label>
                            <input type="text" class="form-control" name="link" id="link" value="{{ $company->link }}">
                            <span id="website_error" class="text-danger"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var logo = document.getElementById("logo").files[0];
        var website = document.getElementById("link").value;

        var nameError = document.getElementById("name_error");
        var emailError = document.getElementById("email_error");
        var logoError = document.getElementById("logo_error");
        var websiteError = document.getElementById("website_error");

        nameError.textContent = "";
        emailError.textContent = "";
        logoError.textContent = "";
        websiteError.textContent = "";

        var isValid = true;

        if (name.trim() === "") {
            nameError.textContent = "Please enter Name";
            isValid = false;
        }else if (name.length < 3) {
                document.getElementById('nameError').textContent = 'Company Name minimum of 3 characters';
        }

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.trim() !== "" && !emailRegex.test(email)) {
            emailError.textContent = "Please enter a valid email address";
            isValid = false;
        } else if (email.trim() === "") {
            emailError.textContent = "Please enter an email address";
            isValid = false;
        }

        if (logo) {
            var img = new Image();
            img.src = URL.createObjectURL(logo);
            img.onload = function() {
                if (img.width < 100 || img.height < 100) {
                    logoError.textContent = "Minimum logo size is 100x100";
                    isValid = false;
                }
            };
        } else {
            logoError.textContent = "Please upload a logo";
            isValid = false;
        }

        if (website.trim() === "") {
            websiteError.textContent = "Please enter Website";
            isValid = false;
        } else {
            var urlRegex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            if (!urlRegex.test(website)) {
                websiteError.textContent = "Please enter a valid URL";
                isValid = false;
            }
        }
        
        return isValid;
    }
</script>
@endsection