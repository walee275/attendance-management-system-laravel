@extends('layouts.main')

@section('title', 'Admin | Attendance')
{{-- {{ dd('hello') }} --}}
@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Attendance</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.students.attendance') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')

                    <form action="{{ route('admin.student.attendance.edit', $attendance) }}" method="POST">
                        @csrf
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Student Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>{{ $attendance->date->format('d-m-Y') }}</td>
                                    <td>{{ $attendance->student->user->name }}</td>

                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status" value="1" {{ $attendance->status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="status">Present</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status" value="0" {{ $attendance->status == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="status">Absent</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status" value="2" {{ $attendance->status == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="status">Leave</label>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <input type="submit" value="Submit" class="btn btn-primary text-black">
                    </form>
                </div>
            </div>
        </div>
    </main>


    {{-- const token = document.querySelector('input[name="_token"]').value; --}}

@endsection
