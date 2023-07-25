@extends('layouts.main')

@section('title', 'Admin | Add Company')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="">Add Company</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('admin.companies') }}" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('partials.alerts')
                        <form action="{{ route('admin.company.create') }}" class="form" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="name">Company Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Please enter  company Name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="name">Company UID</label>
                                        <input type="text" name="uid"
                                            class="form-control @error('uid') is-invalid @enderror" maxlength="15"
                                            placeholder="Please enter  company uid">
                                        @error('uid')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Submit" class="btn btn-dark">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
