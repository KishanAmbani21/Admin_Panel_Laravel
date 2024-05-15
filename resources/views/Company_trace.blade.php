@extends('Layout')

@section('main')

<section class="section">

    <div class="row">
        <div class="col-lg-15">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Company Trace_Data Table</h5>
                    </center>

                    <div class="table-responsive">
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
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('restore', $company->id) }}" method="post"
                                            id="Restoreform">
                                            @csrf
                                            @method('patch')
                                            <button type="button"
                                                onclick="if(confirm('Are you sure you want to Restore? ')){event.preventDefault();document.getElementById('Restoreform').submit()}"
                                                class="btn btn-primary" class="btn btn-primary">Restore</button>
                                        </form>
                                    </td>

                                    <td>
                                        <form action="{{ route('delete', $company->id) }}" method="post"
                                            id="deleteform">
                                            @csrf
                                            @method('delete')
                                            <button type="button"
                                                onclick="if(confirm('Are you sure you want to delete? ')){event.preventDefault();document.getElementById('deleteform').submit()}"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection