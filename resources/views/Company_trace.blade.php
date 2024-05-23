@extends('Layout')

@section('main')

<section class="section">
    <div class="row">
        <div class="col-lg-15">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Company Trace Data Table</h5>

                    <div class="table-responsive">
                        @if($company->isEmpty())
                        <table class="table table-hover" id="companys">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Website Link</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Restore</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                        </table>
                        <p class="text-center">Companies not available in trace data.</p>
                        @else
                        <table class="table table-hover" id="companys">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Website Link</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Restore</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($company as $comp)
                                <tr>
                                    <td>{{ $comp->id }}</td>
                                    <td>{{ $comp->name }}</td>
                                    <td>{{ $comp->email }}</td>
                                    <td>
                                        <img class="card-img-top" src="{{ $comp->logo }}" style="width:100px; height:100px;" alt="Company Logo">
                                    </td>
                                    <td>{{ $comp->link }}</td>
                                    <td>
                                        @if(!$comp->deleted_at && $comp->status == 1)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('restore', $comp->id) }}" method="post" id="Restoreform-{{ $comp->id }}">
                                            @csrf
                                            @method('patch')
                                            <button type="button" onclick="if(confirm('Are you sure you want to restore?')){event.preventDefault();document.getElementById('Restoreform-{{ $comp->id }}').submit()}" class="btn btn-primary">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete', $comp->id) }}" method="post" id="deleteform-{{ $comp->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="if(confirm('Are you sure you want to delete?')){event.preventDefault();document.getElementById('deleteform-{{ $comp->id }}').submit()}" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
