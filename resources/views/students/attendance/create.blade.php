@extends('layouts.main')

@section('title', 'Student | Attendance')
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
                            <a href="{{ route('student.dashboard') }}"
                                class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="{{ route('student.attendance.create', $student) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror" value="" readonly>
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
                                <tr>
                                    <td>1</td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="status">
                                            <span class="slider"></span>
                                          </label>

                                    </td>

                                </tr>

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
