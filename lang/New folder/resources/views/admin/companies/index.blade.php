@extends('layouts.main')

@section('title', 'Admin | Companies')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Comapnies</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">companies</div>
                            <div class="col-6 text-end"><a href="{{ route('admin.company.create') }}" class="btn btn-outline-primary">Create companie</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($companies) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <th>S.R No.</th>
                                    <th>Company Name</th>
                                    <th>Company UID</th>
                                    <th>Actions</th>
                                </thead>

                                <tbody>
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->uid }}</td>
                                            <td><a href="{{ route('admin.company.edit', $company) }}" class="btn btn-outline-primary">Edit</a>
                                                <a href="{{ route('admin.company.destroy', $company) }}" class="btn btn-outline-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert bg-danger">
                                No Data Found
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
