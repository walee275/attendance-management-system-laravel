@extends('layouts.main')

@section('title', 'Admin | Students Attendance')

@section('contents')
    <main>
        <div class="container-fluid px-4 ">
            <div class="card mt-4 d-flex flex-wrap">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Attendance</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.students.attendance.create') }}" class="btn btn-info">Create
                                Attendance</a>
                        </div>
                    </div>

                </div>
                <div class="card-body px-3">
                    @include('partials.alerts')
                    <form action="" method="post" id="attendance-date">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="from-date" class="form-label">From</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="from-date">
                                </div>
                            </div>
                            <div class="col">
                                <label for="to-date" class="form-label">To</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="to-date">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-1">
                                <input type="submit" class="btn btn-primary text-black-50" id="submit" value="submit">
                            </div>
                        </div>
                        <p id="date-error" class="text-danger"></p>
                    </form>
                </div>
            </div>

            <div class="card mt-5 d-none" id="attendance-card">
                <div class="card-header">Attendance Sheet</div>
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



                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end"> </div>
            </div>
        </div>
    </main>

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

    </script>
@endsection
