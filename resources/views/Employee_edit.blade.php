
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

      <div class="col-lg">
        <div class="card" style="margin-top: -100px">
          <div class="card-body">
                <h5 class="card-title text-center">Employee Details Update Form</h5>
                <!-- Your form goes here -->
                <form action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data" method="post" class="row g-3">

                    @csrf
                    @method('put')
                    

                    <div class="col-12">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="firstname" value="{{ $employee->first_name }}">
                    </div>

                    <div class="col-12">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="lastname" value="{{ $employee->last_name }}">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $employee->email }}">
                    </div>

                    <div class="col-12">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="phone" id="phone" value="{{ $employee->phone }}">
                    </div>
            
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
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





    