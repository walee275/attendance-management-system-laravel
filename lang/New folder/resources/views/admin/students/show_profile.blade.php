@extends('layouts.main')

@section('title', 'Admin | Student Profile')

@section('contents')

    <main style="background-color: #eee;">
        <div class="container-fluid px-4">
            <div class="card mt-4" style="background-color: rgb(193, 190, 190)">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Student Profile </h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.students') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')
                    <section>
                        <div class="container py-5">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-4 shadow-sm" style="background-color: lightgray">
                                            <div class="card-body text-center">
                                                <img src="{{ asset('student_uploads/' . $student->user->profile_picture) }}"
                                                    alt="avatar" class="rounded-circle img-fluid mx-auto"
                                                    style="width: 150px; height: 150px">
                                                <h5 class="my-3">{{ $student->user->name }}</h5>
                                                <p class="my-3"> {{ $student->user->Company->name }}</p>

                                                <div class="d-flex justify-content-center mb-2">
                                                    <a href="{{ route('admin.student.edit', $student) }}"
                                                        class="btn btn-primary">Edit Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4" style="background-color: lightgray">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Full Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->user->name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->user->email }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Date of birth</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"> {{ $student->user->dob == '' ? 'N/A' : $student->user->dob }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Gender</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->user->gender }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Phone</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"> {{ $student->user->phone_no == '' ? 'N/A' : $student->user->phone_no }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Address</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->user->address == '' ? 'N/A' : $student->user->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>



                </div>
            </div>
        </div>
    </main>









@endsection
