@extends('layouts.main')

@section('title', 'Admin | Students Leave Requests')

@section('contents')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">{{ $student->name }} || Leave Requests</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @if (count($requests) > 0)

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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $request->student->name }}</td>
                                            <td>{{ $request->student->email }}</td>
                                            <td>{{ $request->reason }}</td>
                                            <td>{{ $request->date->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($request->status == 0)
                                                    <span class="badge bg-primary">Pending</span>
                                                @elseif($request->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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


@endsection
