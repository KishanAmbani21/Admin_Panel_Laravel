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
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  {{--
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Kishan Ambani</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-15">

              <div class="card-body">

                <div class="pt-1 pb-3">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your email & password to login</p>
                </div>

                <form class="row g-3 needs-validation" action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                  
                  @csrf

                  <div class="col-12" style="margin-bottom: 20px;">
                    <label for="email_id" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email_id" value="{{ old('email') }}" >
                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>

                  </div>

                  <div class="col-12" style="margin-bottom: 25px;">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="Password" value="{{ old('password') }}">
                    <span class="text-danger">@error('password') {{ $message }} @enderror</span>
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



</body>

</html>