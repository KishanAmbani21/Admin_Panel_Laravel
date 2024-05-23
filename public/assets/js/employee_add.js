document.addEventListener("DOMContentLoaded", function() {
    var firstnameInput = document.getElementById("firstname");
    var lastnameInput = document.getElementById("lastname");
    var emailInput = document.getElementById("email");
    var phoneInput = document.getElementById("phone");

    var firstnameError = document.getElementById("firstnameError");
    var lastnameError = document.getElementById("lastnameError");
    var emailError = document.getElementById("emailError");
    var phoneError = document.getElementById("phoneError");

    function validateForm() {
        var isValid = true;
        isValid = validateFirstName() && isValid;
        isValid = validateLastName() && isValid;
        isValid = validateEmail() && isValid;
        isValid = validatePhone() && isValid;
        return isValid;
    }

    function validateFirstName() {
        var firstname = firstnameInput.value;
        firstnameError.textContent = "";
        if (firstname === "") {
            firstnameError.textContent = "Employee First Name is required";
            return false;
        } else if (firstname.length < 3) {
            firstnameError.textContent = "Employee First Name must be at least 3 characters";
            return false;
        }
        return true;
    }

    function validateLastName() {
        var lastname = lastnameInput.value;
        lastnameError.textContent = "";
        if (lastname === "") {
            lastnameError.textContent = "Employee Last Name is required";
            return false;
        } else if (lastname.length < 3) {
            lastnameError.textContent = "Employee Last Name must be at least 3 characters";
            return false;
        }
        return true;
    }

    function validateEmail() {
        var email = emailInput.value;
        emailError.textContent = "";
        if (email === "") {
            emailError.textContent = "Employee Email is required";
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

    function validatePhone() {
        var phone = phoneInput.value;
        phoneError.textContent = "";
        if (phone === "") {
            phoneError.textContent = "Phone Number is required";
            return false;
        } else {
            var phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phone)) {
                phoneError.textContent = "Please enter a valid 10-digit phone number";
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

    // Event listeners for input events to trigger validation
    firstnameInput.addEventListener("input", validateFirstName);
    lastnameInput.addEventListener("input", validateLastName);
    emailInput.addEventListener("input", validateEmail);
    phoneInput.addEventListener("input", validatePhone);
});
