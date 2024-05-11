@extends('Layout')

@section('main')

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    
    <div class="row">

        <div class="col-lg-15">

            <div class="card">
                <div class="card-body">

                    
                    <center>
                        <h5 class="card-title">Company Trace_Data Table</h5>
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
                                    
                                    <th>Action1</th>
                                    <th>Action2</th>
                                    

                                </tr>
                            </thead>

                            <tbody>


                                @foreach ($company as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>

                                    <td><img class="card-img-top" src="{{ $company->logo }}" style="width:100px; height:100px;"></td>

                                    <td>{{ $company->link }}</td>

                                    

                                    <td>
                                        @if(!($company->deleted_at == NULL || $company->status == 1))
                                        <span class="btn btn-success btn-sm">Active</span>
                                        @else
                                        <span class="btn btn-secondary btn-sm">Inactive</span>
                                        @endif
                                    </td>

                                    {{-- <td>{{ $company->created_at }}</td> --}}
                                    {{-- <td>{{ $company->updated_at }}</td> --}}
                                    {{-- <td>{{ $company->deleted_at }}</td> --}}

                                    <td>
                                        <form action="{{ route('restore', $company->id) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-primary">Restore</button>
                                        </form>
                                    </td>
                                    
                                    <td>
                                        <form action="{{ route('delete', $company->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with hoverable rows -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection