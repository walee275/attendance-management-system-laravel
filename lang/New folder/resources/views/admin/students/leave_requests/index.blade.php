@extends('layouts.main')

@section('title', 'Admin | Students Leave Requests')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Students Leave Request</h3>
                        </div>
                        <div class="col-6 text-end">
                            {{-- <a href="{{ route('admin.student.create') }}" class="btn btn-outline-primary">Add Student</a> --}}
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="{{ route('admin.students.leave.requests') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <select name="status" class="form-select">
                                    <option value="" selected>Search Specific Requests</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                            <input type="submit" class="col-sm-2 mb-3 btn btn-outline-primary">
                        </div>
                        <p id="error" class="text-danger"></p>
                    </form>
                    @if (count($leave_requests) > 0)

                        <div class="table-responsive">
                            <table class="table table-bordered  table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Leave Reason</th>
                                        <th>Leave Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leave_requests as $leave_request)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $leave_request->student->user->name }}</td>
                                            <td>{{ $leave_request->student->user->email }}</td>
                                            <td>{{ $leave_request->reason }}</td>
                                            <td>{{ $leave_request->date->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($leave_request->status == 0)
                                                    <span class="badge bg-primary">Pending</span>
                                                @elseif($leave_request->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('admin.student.approve.leave.request', $leave_request) }}" class="btn btn-success" >Approve
                                                </a>
                                                <a href="{{ route('admin.student.reject.leave.request', $leave_request) }}" class="btn btn-danger" id="reject-btn">Reject</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered d-none  table-hover" id="table-2">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Leave Reason</th>
                                        <th>Leave Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-2">

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            No record found!
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        const dateForm = document.getElementById('date-form');
        dateForm.addEventListener('submit', function(e) {
            e.preventDefault();


            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd; //formating the date;

            const DateElement = document.getElementById('date');
            const token = document.querySelector('input[name="_token"]').value;
            const FromdateValue = DateElement.value;
            const TodateValue = today;

            const table1 = document.getElementById('table-1')
            const table2 = document.getElementById('table-2')
            const error = document.getElementById('error')

            // attendanceCard.classList.add('d-none');
            DateElement.classList.remove('is-invalid');
            error.innerText = '';


            if (FromdateValue == '' || FromdateValue === undefined) {
                DateElement.classList.add('is-invalid');
            } else {
                const data = {
                    from_date: FromdateValue,
                    to_date: TodateValue,
                    _token: token,
                };

                fetch('{{ route('admin.fetch.leave.requests') }}', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function(response) {
                    return response.json();
                }).then(function(result) {
                    const tbody2 = document.getElementById('tbody-2');
                    error.innerText = '';

                    DateElement.classList.remove('is-invalid');
                    if (result.error) {
                        FromdateElement.classList.add('is-invalid');
                        error.innerText = 'Error: ' + result.error;

                    } else if (!result) {
                        DateElement.classList.add('is-invalid');
                        error.innerText = 'No data found!';
                        table2.classList.add('d-none');
                        // console.log(result);

                    } else {
                        table1.classList.add('d-none');

                        const output = '';
                        table2.classList.remove('d-none');
                        tbody2.innerHTML = result;
                        // console.log(num1)


                    }
                });

            }
        });




        function StatusUpdate(id) {}
    </script>
@endsection
