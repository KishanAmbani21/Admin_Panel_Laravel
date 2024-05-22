<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- CSS cdn-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    .msgpopup {
      position: fixed;
      top: 0;
      left: 45%;
      transform: translateX(-30%);
      z-index: 9999;
      width: 50%;
      max-width: 400px;
      animation: slideInOut2 0.6s forwards, disappear 5s forwards;
    }

    @keyframes slideInOut2 {
      0% {
        top: -100%;
      }

      100% {
        top: 10%;
      }
    }

    @keyframes disappear {
      0% {
        opacity: 1;
      }

      100% {
        opacity: 0;
        display: none;
      }
    }
  </style>

</head>

<body>


  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">

        @if(Session::has('success'))
        <div class="msgpopup">
          <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show text-center">
            {{ Session('success') }}
          </div>
        </div>
        @endif

        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Kishan Ambani</span>
              </a>
            </div>

            <div class="card mb-15">
              <div class="card-body">
                <div class="pt-1 pb-3">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your email & password to login</p>
                </div>

                <form class="row g-3 needs-validation" action="{{ route('login.post') }}" method="POST"
                  enctype="multipart/form-data" id="myForm">

                  @csrf

                  @if ($errors->has('loginError'))
                  <div class="alert alert-danger">
                    {{ $errors->first('loginError') }}
                  </div>
                  @endif

                  @if($errors->has('email'))
                  <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                  @endif

                  @if($errors->has('password'))
                  <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                  @endif

                  <div class="col-12" style="margin-bottom: 20px;">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}">
                    <span id="emailError" class="error text-danger"></span>
                  </div>

                  <div class="col-12" style="margin-bottom: 25px;">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                      value="{{ old('password') }}">
                    <span id="passwordError" class="error text-danger"></span>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>

  <script src="assets/js/main.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("myForm");

    form.addEventListener("submit", function(event) {
        
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        
        var emailError = document.getElementById("emailError");
        var passwordError = document.getElementById("passwordError");

        emailError.textContent = "";
        passwordError.textContent = "";

        if (email === "") {
            emailError.textContent = "Email is required";
            event.preventDefault();
        } else if (!isValidEmail(email)) {
            emailError.textContent = "Please enter a valid email address";
            event.preventDefault();
        }

        if (password === "") {
            passwordError.textContent = "Password is required";
            event.preventDefault();
        }

        function isValidEmail(email) {
            var emailRegex = /\S+@(admin)+\.(com)$/;
            return emailRegex.test(email);
        }
      });
    });
  </script>

</body>

</html>
