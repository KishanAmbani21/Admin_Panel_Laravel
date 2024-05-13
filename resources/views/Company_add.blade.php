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
    
                    <!-- Your form goes here -->
                    <form  action="{{ route('company.store') }}" enctype="multipart/form-data" method="post"
                        class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-12">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo" value="{{ old('logo') }}">
                            <span class="text-danger">@error('logo') {{ $message }} @enderror</span>
    
                        </div>
                        
                        <div class="col-12">
                            <label for="link" class="form-label">Website Link</label>
                            <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}">
                        </div>
                        <button  type="submit" class="btn btn-primary">Submit</button>
                    </form>
    
    
                </div>
            </div>
    
        </div>
    </section>

</main><!-- End #main -->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>