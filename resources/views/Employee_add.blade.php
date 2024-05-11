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


                            <h5 class="card-title text-center">Add Employee Details Form</h5>
                            <!-- Your form goes here -->
                            <form action="{{ route('employee.store') }}" enctype="multipart/form-data" method="post"
                                class="row g-3">

                                @csrf
                                @method('post')

                                <div class="col-12">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="firstname"
                                        value="{{ old('first_name') }}">
                                    <span class="text-danger">@error('first_name') {{ $message }} @enderror</span>
                                </div>

                                <div class="col-12">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="lastname"
                                        value="{{ old('last_name') }}">
                                        <span class="text-danger">@error('last_name') {{ $message }} @enderror</span>
                                    
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}">
                                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>

                                </div>

                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" name="phone" id="phone"
                                        value="{{ old('phone') }}">
                                    <span class="text-danger">@error('phone') {{ $message }} @enderror</span>

                                </div>

                                {{-- <div class="form-group">
                                    <label>Company</label>
                                    @if (request('id'))
                                    <input type="" class="form-control" name="company" value="{{$company->name}}">
                                    @else
                                    <input type="" class="form-control" name="company" value="">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Company</label>
                                    <select name="company" class="form-select" required>
                                        <option selected>Company default</option>
                                        @foreach($company as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                @if(isset($company->id))
                                <div class="form-group">
                                    <label>Company</label>
                                    @if (request('id'))
                                    {{-- <input type="" class="form-control" name="company" value="{{$company->name}}"> --}}
                                    <select name="company" class="form-select" required>
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    </select>
                                    @endif
                                </div>
                                @else
                                <div class="form-group">
                                    <label>Company</label>
                                    <select name="company" class="form-select" required>
                                        <option selected>Company default</option>
                                        @foreach($company as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                <button type="submit" class="btn btn-primary">Submit</button>

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