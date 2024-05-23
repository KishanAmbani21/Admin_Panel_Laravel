document.addEventListener("DOMContentLoaded", function () {
    var nameInput = document.getElementById("name");
    var emailInput = document.getElementById("email");
    var logoInput = document.getElementById("logo");
    var websiteInput = document.getElementById("link");

    var nameError = document.getElementById("nameError");
    var emailError = document.getElementById("emailError");
    var logoError = document.getElementById("logoError");
    var websiteError = document.getElementById("websiteerror");

    function validateForm() {
        var isValid = true;
        isValid = validateName() && isValid;
        isValid = validateEmail() && isValid;
        isValid = validateLogo() && isValid;
        isValid = validateWebsite() && isValid;
        return isValid;
    }

    function validateName() {
        var name = nameInput.value;
        nameError.textContent = "";
        if (name === "") {
            nameError.textContent = "Company Name is required";
            return false;
        } else if (name.length < 3) {
            nameError.textContent = "Company Name must be at least 3 characters";
            return false;
        }
        return true;
    }

    function validateEmail() {
        var email = emailInput.value;
        emailError.textContent = "";
        if (email === "") {
            emailError.textContent = "Company Email is required";
            return false;
        } else {
            var emailRegex = /^[a-z]+[a-z0-9]+@[a-z]+\.(com|in|org|net)$/;
            if (!emailRegex.test(email)) {
                emailError.textContent = "Please enter a valid email address";
                return false;
            }
        }
        return true;
    }

    function validateLogo() {
        var logo = logoInput.files[0];
        logoError.textContent = "";
        if (!logo) {
            logoError.textContent = "Company logo is required";
            return false;
        } else {
            var validTypes = ["image/jpeg", "image/png", "image/jpg"];
            if (!validTypes.includes(logo.type)) {
                logoError.textContent = "Please upload a JPEG, JPG, or PNG image";
                return false;
            } else {
                var img = new Image();
                img.src = URL.createObjectURL(logo);
                img.onload = function () {
                    if (img.width < 100 || img.height < 100) {
                        logoError.textContent = "Minimum logo size is 100x100";
                    }
                };
                img.onerror = function () {
                    logoError.textContent = "Error loading the image";
                };
            }
        }
        return true;
    }

    function validateWebsite() {
        var website = websiteInput.value.trim();
        websiteError.textContent = "";
        if (website === "") {
            websiteError.textContent = "Company Website is required";
            return false;
        } else {
            var urlRegex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{3}?(\/.*)?$/;
            if (!urlRegex.test(website)) {
                websiteError.textContent = "Please enter a valid URL";
                return false;
            }
        }
        return true;
    }

    var form = document.getElementById("myForm");
    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    // Optional: If you want to trigger validation on input change
    nameInput.addEventListener("input", validateName);
    emailInput.addEventListener("input", validateEmail);
    logoInput.addEventListener("input", validateLogo);
    websiteInput.addEventListener("input", validateWebsite);
});
