@extends('layouts.main')

@section('title', 'Admin | Student Attendance')
{{-- {{ dd($students) }} --}}
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
                            <a href="{{ route('admin.students.attendance') }}"
                                class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="{{ route('admin.students.attendance.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" >
                            @error('date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="{{ $student->id }}"
                                                id="student_{{ $student->id }}_present" value="1" checked>
                                            <label class="form-check-label"
                                                for="student_{{ $student->id }}_present">Present</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="{{ $student->id }}"
                                                id="student_{{ $student->id }}_absent" value="0">
                                            <label class="form-check-label"
                                                for="student_{{ $student->id }}_absent">Absent</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="{{ $student->id }}"
                                                id="student_{{ $student->id }}_absent" value="2">
                                            <label class="form-check-label"
                                                for="student_{{ $student->id }}_absent">Leave</label>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <input type="submit" value="Submit" class="btn btn-primary text-black-50">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;  //formating the date;

        const dateElement = document.getElementById("date");
        dateElement.value = today;
        dateElement.setAttribute('value', today);

    </script>
@endsection
