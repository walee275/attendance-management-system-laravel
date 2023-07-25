@extends('layouts.main')


@if (Auth::user()->hasRole('super_admin'))

@section('title', 'Admin | Dashboard')

@section('contents')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">

        </div>
    </div>
</main>
@endsection

@elseif (Auth::user()->hasRole('student'))

@section('title', 'Student | Dashboard')

@section('contents')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <a href="{{ route('student.attendances') }}" class="btn btn-dark mb-3">See Attendace </a>
            <a href="{{ route('student.attendance.create', $student) }}" class="btn btn-primary mb-3">Mark Attendace </a>
            <a href="{{ route('student.leave.request.create', $student) }}" class="btn btn-primary mb-3">Request For Leave</a>
            <a href="{{ route('student.leave.requests.index', $student) }}" class="btn btn-success mb-3">Requests Submitted</a>
        </div>
    </div>
</main>
@endsection


@endif
