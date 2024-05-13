<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Company Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- CSS cdn-->

    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 

    <style>
        #companys {
            border-collapse: collapse;
        }

        #companys td,
        #companys th {
            border: 1px solid #859cbe;
            padding: 8px;
            text-align: center;
        }

        #companys th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4154F1;
            color: white;
            text-align: center;
        }
        .msgpopup {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-30%);
        z-index: 9999;
        width: 20%;
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

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn" style="margin-right: 30px;"></i>
            <a href="{{ url('/dashboard') }}" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Kishan Ambani</span>
            </a>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->


                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number"></span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have a new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ url('/dashboard') }}" data-bs-toggle="dropdown">
                        <img src="assets/img/Kishan.jpg" alt="Profile">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Kishan Ambani</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kishan Ambani</h6>
                            <span>Web Developer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>



                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout', []) }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    @if(Session::has('success'))
    {{-- <span class="msgpopup"><p>{{ session('success') }}</p></span> --}}
    <div class="msgpopup">
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show text-center">
            {{ Session('success') }}
        </div>
    </div>
    @endif
    @if(Session::has('delete'))
    {{-- <span class="msgpopup"><p>{{ session('success') }}</p></span> --}}
    <div class="msgpopup">
        <div class="alert alert-success bg-danger text-light border-0 alert-dismissible fade show text-center">
            {{ Session('delete') }}
        </div>
    </div>
    @endif
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('company.index') }}">
                    <i class="ri-building-4-fill"></i><span>Company</span>
                </a>

            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('employee.index') }}">
                    <i class="bi bi-person-square"></i><span>Employee</span>
                </a>

            </li><!-- End Components Nav -->

        </ul>

    </aside><!-- End Sidebar-->



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Company Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Company</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    
        <section class="section">
    
            <div class="row">
    
                <div class="col-lg-15">
    
                    <div class="card">

                        <form class="form-inline">
                            <input class="form-control mr-2" type="search" name="search">
                            <button class="btn btn-primary" type="submit">Search</button>
                          </form>

                          

                        <div class="card-body">
    
                            <div style="margin-top: 30px; margin-left: 4px;"><a class="btn btn-primary" href="{{ route('company.create') }}">Add Company</a></div>
                            <div style="margin-top: 30px; margin-left: 4px;"><a class="btn btn-danger" href="{{ route('trace_data') }}">All Trace Data</a></div>
                            
                            <center>
                                <h5 class="card-title">Company Data Table</h5>
                            </center>
    
                            <!-- Make the table responsive -->
                            <div class="table-responsive">
                                <!-- Table with hoverable rows -->
                                <table class="table table-hover" id="companys">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Website Link</th>
                                            <th scope="col">Status</th>
                                            
                                            <th>Add Employee</th>
                                            <th>Action1</th>
                                            <th>Action2</th>
                                            <th>Action3</th>
    
                                        </tr>
                                    </thead>
    
                                    <tbody>
    
    
                                        @foreach ($companies as $company)
                                        <tr>
                                            <td>{{ $company->id }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->email }}</td>
    
                                            <td> <img class="card-img-top" src="{{ $company->logo }}" style="width:100px; height:100px;"> </td>
    
                                            <td>{{ $company->link }}</td>
    
                                            <td>
                                                @if($company->deleted_at == NULL || $company->status == 1)
                                                    <span class="btn btn-success btn-sm">Active</span>
                                                @else
                                                    <span class="btn btn-secondary btn-sm">Inactive</span>
                                                @endif
                                            </td>
    
                                            <td>
                                                <a class="btn btn-secondary"
                                                    href="{{ route('employee.create', ['id'=>$company->id]) }}">Get</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="{{ route('company.show', $company->id) }}">Show</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-success"
                                                    href="{{ route('company.edit', $company->id) }}">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('company.destroy', $company->id) }}" method="post" id='deleteform'>
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to trace? ')){event.preventDefault();document.getElementById('deleteform').submit()}">Trace</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $companies->links() !!}
                            </div>
                            <!-- End Table with hoverable rows -->
    
                        </div>
                    </div>
    
                </div>
            </div>
        </section>

        
        
    </main><!-- End #main -->
    

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Kishan Ambani</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Kishan Ambani</a>
        </div>
    </footer><!-- End Footer -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


</body>

</html>