@extends('layouts.main')

@section('title', 'Admin | Add Students')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Add Student</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.students') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('admin.student.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Enter the name">

                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Enter the email">

                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}"
                                            placeholder="Enter the phone">

                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cnic">CNIC</label>
                                        <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                            id="cnic" name="cnic" value="{{ old('cnic') }}"
                                            placeholder="Enter the cnic">

                                        @error('cnic')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="dob">DoB</label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                id="dob" name="dob" value="{{ old('dob') }}">

                                            @error('dob')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="picture">Profile Picture</label>
                                            <input type="file"
                                                class="form-control @error('picture') is-invalid @enderror" id="picture"
                                                name="picture">

                                            @error('picture')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label>Gender</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="Male" checked>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="Female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>

                                            @error('gender')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label>Company</label>
                                            <select name="company" id="company" class="form-select">
                                                <option value="">Please select a company</option>
                                                @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">

                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" id="address" cols="30" rows="3"
                                    placeholder="Enter the address">{{ old('address') }}</textarea>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Submit" class="btn btn-primary text-black-50">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
