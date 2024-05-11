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

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card p-5 d-flex flex-column align-items-center">

              <img src="{{ $company->logo }}" alt="Profile" width="150px" height="150px">
              <h2>{{ $company->name }}</h2>
              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body">
              <!-- Bordered Tabs -->

              <div class="tab-content">

                <div class="tab-pane fade show active profile-overview" id="profile-overview" style="margin-bottom: -11px;">
                  
                  <h5 class="card-title text-center">Company Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company Id :</div>
                    <div class="col-lg-9 col-md-8">{{ $company->id }}</div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Company Name :</div>
                    <div class="col-lg-9 col-md-8">{{ $company->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company Email :</div>
                    <div class="col-lg-9 col-md-8">{{ $company->email }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Website Link</div>
                    <div class="col-lg-9 col-md-8">{{ $company->link }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>


                </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

          @if ($employee)
          <div class="card">
            <div class="card-body">

                <center>
                    <h5 class="card-title">Employee List</h5>
                </center>

                <!-- Table with hoverable rows -->
                <table class="table table-hover" id="companys" >
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">First_name</th>
                            <th scope="col">Last_name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
        
                            <th>Action1</th>
                            <th>Action2</th>
                            {{-- <th>Action3</th> --}}

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($employee as $employee)
                            
                        
                        <tr>

                          
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ !empty($employee->company) ? $employee->company->name : '' }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>

                            {{-- <td><img class="card-img-top" src="{{ $employee->logo }} " width="100px"
                                    height="100px"></td>

                            <td>{{ $employee->link }}</td>

                            <td>{{ $employee->status }}</td> --}}

                            {{-- <td>{{ $employee->created_at }}</td> --}}
                            {{-- <td>{{ $employee->updated_at }}</td> --}}
                            {{-- <td>{{ $employee->deleted_at }}</td> --}}

                            <td>
                                <a class="btn btn-warning"
                                    href="{{ route('employee.show', $employee->id) }}">Show</a>
                            </td>
                            <td>
                                <a class="btn btn-success"
                                    href="{{ route('employee.edit', $employee->id) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('employee.destroy', $employee->id) }}" method="post" id='deleteform'>
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->

            </div>
        </div>
          @endif
          

        </div>
      </div>
    </section>
    
@endsection