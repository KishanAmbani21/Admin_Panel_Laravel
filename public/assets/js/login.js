document.addEventListener("DOMContentLoaded", function () {
    var emailInput = document.getElementById("email");
    var passwordInput = document.getElementById("password");

    var emailError = document.getElementById("emailError");
    var passwordError = document.getElementById("passwordError");

    function validateForm() {
        var isValid = true;
        isValid = validateEmail() && isValid;
        isValid = validatePassword() && isValid;
        return isValid;
    }

    function validateEmail() {
        var email = emailInput.value;
        emailError.textContent = "";
        if (email === "") {
            emailError.textContent = "Email is required";
            return false;
        } else {
            var emailRegex = /[a-z]+@(admin)+\.(com)$/;
            if (!emailRegex.test(email)) {
                emailError.textContent = "Please enter a valid email address";
                return false;
            }
        }
        return true;
    }

    function validatePassword() {
        var password = passwordInput.value;
        passwordError.textContent = "";
        if (password === "") {
            passwordError.textContent = "Password is required";
            return false;
        }else if (password.length < 4) {
            passwordError.textContent = "Password Minimum length is 4";
            return false;
        }
        return true;
    }

    var form = document.getElementById("myForm");
    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    // Event listeners for input events to trigger validation
    emailInput.addEventListener("input", validateEmail);
    passwordInput.addEventListener("input", validatePassword);
});
