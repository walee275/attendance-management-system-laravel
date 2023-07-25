@extends('layouts.main')

@section('title',' | Student Profile')

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
                            <a href="{{ route('student.dashboard', $student) }}" class="btn btn-outline-primary">Back</a>
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
                                        <div class="card mb-4 shadow-sm " style="background-color: lightgray">
                                            <div class="card-body text-center">
                                                <img src="{{ asset('student_uploads/' . $student->profile_picture) }}"
                                                    alt="avatar" class="rounded-circle img-fluid mx-auto"
                                                    style="width: 150px; height: 150px">
                                                <h5 class="my-3">{{ $student->name }}</h5>
                                                {{-- @if ($student->status == 1)
                                                    <span class="text-white badge bg-success mb-3">Active</span>
                                                @else
                                                    <p class="text-white badge bg-danger  mb-3">Inactive</p>
                                                @endif --}}
                                                <p class="text-muted mb-">
                                                    @if ($student->qualification == '')
                                                        N/A
                                                    @else
                                                        {{ $student->qualification }}
                                                    @endif
                                                </p>
                                                <div class="d-flex justify-content-center mb-2">
                                                    <a href="{{ route('student.edit', $student) }}"
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
                                                        <p class="text-muted mb-0">{{ $student->name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->email }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Date of birth</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($student->dob == '')
                                                                N/A
                                                            @else
                                                                {{ $student->dob }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Qualification</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($student->qualification == '')
                                                                N/A
                                                            @else
                                                                {{ $student->qualification }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Gender</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->gender }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Phone</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($student->phone_no == '')
                                                                N/A
                                                            @else
                                                                {{ $student->phone_no }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Address</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->address }}</p>
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
