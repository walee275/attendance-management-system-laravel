@extends('layouts.main')

@section('title', 'Student | Attendance')
{{-- {{ dd($attendances) }} --}}
@section('contents')
    <main>
        <div class="container-fluid px-4 ">
            @if (count($attendances) > 0)
                <div class="card mt-5" id="attendance-card">
                    <div class="card-header d-flex">
                        <div class="col">Attendance Sheet</div>
                        <div class="col text-end"><a class=" btn btn-outline-primary"
                                href="{{ route('student.dashboard') }}">Back</a></div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Student Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-attendance" class=" ">
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->date->format('d-M-Y') }}</td>
                                        <td>{{ $attendance->student->name }}</td>
                                        <td>
                                            @if ($attendance->status == 1)
                                                <span class="badge bg-success">Present</span>
                                            @elseif ($attendance->status == 2)
                                                <span class="badge bg-warning">On Leave</span>
                                            @else
                                                <span class="badge bg-danger">Absent</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>

                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    No record found!
                </div>
            @endif
        </div>
    </main>
    {{--
    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd; //formating the date;

        const FromDateElement = document.getElementById("from-date");
        FromDateElement.value = today;
        FromDateElement.setAttribute('value', today);




        const dateForm = document.getElementById('attendance-date');
        dateForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const FromdateElement = document.getElementById('from-date');
            const TodateElement = document.getElementById('to-date');
            let dateError = document.getElementById('date-error');

            const token = document.querySelector('input[name="_token"]').value;
            const FromdateValue = FromdateElement.value;
            const TodateValue = TodateElement.value;

            const attendanceCard = document.getElementById('attendance-card')

            // attendanceCard.classList.add('d-none');
            FromdateElement.classList.remove('is-invalid');
            TodateElement.classList.remove('is-invalid');


            if (FromdateValue == '' || FromdateValue === undefined) {
                FromdateElement.classList.add('is-invalid');
                dateError.innerText = 'No valid date choosen!';
            } else if (TodateValue == '' || TodateValue === undefined) {
                TodateElement.classList.add('is-invalid');
                dateError.innerText = 'No valid date choosen!';
            }  else {
                const data = {
                    from_date: FromdateValue,
                    to_date: TodateValue,
                    _token: token,
                };

                fetch('{{ route('admin.fetch.attendances') }}', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function(response) {
                    return response.json();
                }).then(function(result) {
                    const attendanceTableBody = document.getElementById('tbody-attendance');

                    attendanceCard.classList.add('d-none');
                    FromdateElement.classList.remove('is-invalid');
                    TodateElement.classList.remove('is-invalid');
                    dateError.innerText = '';
                    if (result.error) {
                        FromdateElement.classList.add('is-invalid');
                        TodateElement.classList.add('is-invalid');
                        dateError.innerText = result.error;
                        attendanceCard.classList.add('d-none');

                    } else if (!result) {
                        FromdateElement.classList.add('is-invalid');
                        TodateElement.classList.add('is-invalid');
                        dateError.innerText = 'No Attendance Found!';
                        attendanceCard.classList.add('d-none');
                        console.log(result);

                    } else {
                        const output = '';
                        attendanceCard.classList.remove('d-none');
                        attendanceTableBody.innerHTML = result;
                        // console.log(num1)


                    }
                });

            }
        });

    </script> --}}
@endsection
