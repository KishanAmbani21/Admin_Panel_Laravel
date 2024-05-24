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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- CSS CDN -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Popup CSS File -->
    <link href="assets/css/popup.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn" style="margin-right: 30px;"></i>
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="Logo">
                <span class="d-none d-lg-block">Kishan Ambani</span>
            </a>
        </div>

        <nav class="header-nav ms-auto" aria-label="breadcrumb">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ url('/') }}" data-bs-toggle="dropdown">
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

    <!-- ======= Success and Fail Messages ======= -->
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

    <!-- ======= Main Content ======= -->
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Search, Add and Trace Buttons -->
                            <div class="d-flex justify-content-between">
                                <form class="form-inline" style="margin: 30px; margin-left: 3px;">
                                    <input class="form-control mr-2" type="search" name="search" placeholder="Search here..">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </form>
                                <div class="d-flex">
                                    <a class="btn btn-primary" style="margin: 30px 10px;" href="{{ route('company.create') }}">Add Company</a>
                                    <a class="btn btn-danger" style="margin: 30px 10px;" href="{{ route('trace_data') }}">All Trace Data</a>
                                </div>
                            </div>

                            <h5 class="card-title text-center">Company Data Table</h5>

                            <!-- Company Data Table -->
                            <div class="table-responsive">
                                @if($companies->isEmpty())
                                <table class="table table-hover" id="companys">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Website Link</th>
                                            <th scope="col">Status</th>
                                            <th>Action1</th>
                                            <th>Action2</th>
                                        </tr>
                                    </thead>
                                </table>
                                <p class="text-center">Companies not available.</p>
                                @else
                                <table class="table table-hover" id="companys">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
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
                                            <td><img class="card-img-top" src="{{ asset('storage/logo/' . $company->logo) }}" style="width:100px; height:100px;" alt="Logo"></td>
                                            <td>{{ $company->email }}</td>
                                            <td><a href="{{ $company->link }}" target="_blank">{{ $company->link }}</a></td>
                                            <td>
                                                @if($company->deleted_at == NULL || $company->status == 1)
                                                <span class="badge bg-success">Active</span>
                                                @else
                                                <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary" href="{{ route('employee.create', ['id'=>$company->id]) }}">Add</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{ route('company.show', $company->id) }}">Show</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{ route('company.edit', $company->id) }}">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('company.destroy', $company->id) }}" method="post" id="delete-{{ $company->id }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to trace?')){event.preventDefault();document.getElementById('delete-{{ $company->id }}').submit()}">Trace</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>

                            <!-- Pagination -->
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
            &copy; <strong><span>Kishan Ambani</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Kishan Ambani</a>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
