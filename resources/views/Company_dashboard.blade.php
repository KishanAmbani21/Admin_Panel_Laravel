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

    <!-- CSS CDN -->
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

    <!-- ======= header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn" style="margin-right: 30px;"></i>
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Kishan Ambani</span>
            </a>
        </div>

        <nav class="header-nav ms-auto" aria-label="breadcrumb">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ url('/') }}"
                        data-bs-toggle="dropdown">
                        <img src="assets/img/Kishan.jpg" alt="Profile">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Kishan Ambani</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kishan Ambani</h6>
                            <span>Web Developer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                            
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    @if(Session::has('success'))
    <div class="msgpopup">
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show text-center">
            {{ Session('success') }}
        </div>
    </div>
    @endif
    @if(Session::has('delete'))
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
                <a class="nav-link collapsed" href="{{ url('/') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('company.index') }}">
                    <i class="ri-building-4-fill"></i><span>Company</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('employee.index') }}">
                    <i class="bi bi-person-square"></i><span>Employee</span>
                </a>
            </li>
        </ul>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Company Tables</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Company</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-15">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <form class="form-inline" style="margin: 30px; margin-left:3px;">
                                        <input class="form-control mr-2" type="search" name="search"
                                            placeholder="Search here..">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </form>
                                </div>
                                <div style="display: flex">
                                    <div style="margin-top: 30px; margin-left: 10px;">
                                        <a class="btn btn-primary" href="{{ route('company.create') }}">Add Company</a>
                                    </div>
                                    <div style="margin-top: 30px; margin-left: 10px;">
                                        <a class="btn btn-danger" href="{{ route('trace_data') }}">All Trace Data</a>
                                    </div>
                                </div>
                            </div>

                            <h5 class="card-title" style="text-align: center;">Company Data Table</h5>


                            <div class="table-responsive">
                                @if($companies->isEmpty())
                                <table class="table table-hover" id="companys">
                                    <th>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Website Link</th>
                                            <th scope="col">Status</th>
        
                                            <th>Action1</th>
                                            <th>Action2</th>
                                        </tr>
                                    </th>
                                </table>
                                    <p style="text-align:center;">companies Not available.</p>
                                @else
                                <table class="table table-hover" id="companys">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Website Link</th>
                                            <th scope="col">Status</th>
                                            <th>Employee</th>
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
                                            <td><img class="card-img-top" src="{{ $company->logo }}"
                                                    style="width:100px; height:100px;" alt="as"></td>
                                            <td>{{ $company->email }}</td>
                                            <td> <a href="{{ $company->link }}" target="_blank">{{ $company->link }}</a>
                                            </td>
                                            <td>
                                                @if($company->deleted_at == NULL || $company->status == 1)
                                                <span class="badge bg-success">Active</span>
                                                @else
                                                <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary"
                                                    href="{{ route('employee.create', ['id'=>$company->id]) }}">Add</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-success"
                                                    href="{{ route('company.show', $company->id) }}">Show</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="{{ route('company.edit', $company->id) }}">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('company.destroy', $company->id) }}"
                                                    method="post" id='deleteform'>
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button class="btn btn-danger"
                                                    onclick="if(confirm('Are you sure you want to trace? ')){event.preventDefault();document.getElementById('deleteform').submit()}">Trace</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $companies->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Kishan Ambani</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Kishan Ambani</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>

</body>

</html>
