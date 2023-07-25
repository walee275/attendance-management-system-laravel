@extends('layouts.main')

@section('title', 'Admin | Admin Profile')

@section('contents')
{{-- @foreach ($admins as $admin )
{{ dd($admin->user) }}

@endforeach --}}

    <main style="background-color: #eee;">
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Admin Profile </h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')
                    <section >
                        <div class="container py-5">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                <img src="{{ asset('admin_uploads/' . $admin->profile_picture) }}"
                                                    alt="avatar" class="rounded-circle img-fluid"
                                                    style="width: 150px; height: 150px">
                                                <h5 class="my-3">{{ $admin->name }}</h5>
                                                {{-- @if ($admin->user->status == 1)
                                                    <span class="text-white badge bg-success mb-3">Active</span>
                                                @else
                                                    <p class="text-white badge bg-danger  mb-3">Inactive</p>
                                                @endif --}}
                                                <p class="text-muted mb-">
                                                    {{-- @if ($admin->role->role == '')
                                                        N/A
                                                    @else
                                                        {{ $admin->qualification }}
                                                    @endif --}}
                                                </p>
                                                <div class="d-flex justify-content-center mb-2">
                                                    <a href="{{ route('admin.profile.edit', $admin) }}"
                                                        class="btn btn-primary">Edit Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Full Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $admin->name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $admin->email }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Date of birth</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($admin->dob == '')
                                                            N/A
                                                        @else
                                                        {{ $admin->dob }}
                                                        @endif</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Qualification</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($admin->qualification == '')
                                                                N/A
                                                            @else
                                                                {{ $admin->qualification }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Occupation</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($admin->occupation == '')
                                                                N/A
                                                            @else
                                                                {{ $admin->occupation }}
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
                                                        <p class="text-muted mb-0">{{ $admin->gender }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Phone</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($admin->phone_no == '')
                                                            N/A
                                                        @else
                                                        {{ $admin->phone_no }}
                                                        @endif</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Address</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($admin->address == '')
                                                                N/A
                                                            @else
                                                                {{ $admin->address }}
                                                            @endif
                                                        </p>
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




{{-- <div class="text-center row w-25">
                    <img src="{{ asset('uploads/' . $student->user->profile_picture) }}" alt="image" width="150" class="text-center rounded-circle">
                </div>
                <hr>
                <div class="row">
                  <div class="col" style="text-align: justify;">
                    <div class="d-flex " style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Name:</span>
                        <p> {{ $student->user->name }}</p>
                    </div>
                    <div class="d-flex" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Email: </span>
                        <h5>{{ $teacher->user->email }}</h5>
                    </div>
                    <div class="d-flex justify-content-around text-start" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Course: </span>
                        <p>{{ $teacher->course->name }}</p>
                    </div>
                    <div class="d-flex justify-content-around text-start" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Shift: </span>
                        <p>{{ $teacher->shift }}</p>
                    </div>
                    <a href="{{ route('admin.teacher.edit', $teacher) }}" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="col" style="border-left: 1px solid rgb(207, 204, 204)" >
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">CNIC: </span>
                        <p class="mx-auto"> {{ $teacher->user->cnic }}</p>
                    </div>
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Phone-No: </span>
                        <p class="mx-auto"> {{ $teacher->user->phone_no }}</p>
                    </div>
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Date of birth: </span>
                        <p class="mx-auto"> {{ $teacher->user->dob }}</p>
                    </div>
                    <div class="d-flex container justify-content-between" style="border-bottom: 1px solid rgb(207, 204, 204)">
                        <span class="fw-bold">Gender: </span>
                        <p class="mx-auto"> {{ $teacher->user->gender }}</p>
                    </div>

                    <p><span class="fw-bold">Address: </span> {{ $teacher->user->address}}</p>
                  </div>
                </div> --}}
