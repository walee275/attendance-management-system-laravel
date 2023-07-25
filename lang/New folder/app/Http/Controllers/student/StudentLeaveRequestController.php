<?php

namespace App\Http\Controllers\student;

use App\Models\Student;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class StudentLeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        $data = [
            'student' => $student,
            'requests' => LeaveRequest::where('student_id', $student->id)->get()
        ];

        return view('students.leave_request.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student)
    {

        $data = [
            'student' => $student
        ];

        return view('students.leave_request.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        // dd($request->all());s
            $request->validate([
                'date' => [
                    'required',
                    Rule::unique('leave_requests')->where(fn ($query) => $query->where([
                        ['student_id', $student->id],
                        ['date', $request->date],
                    ]))
                ],
                'reason' => ['required'],
            ], [
                'date.unique' => 'A request for this date already exist!'
            ]);

        $data = [
            'student_id' => $student->id,
            'date' => $request->date,
            'reason' => $request->reason,
            'status' => 0,
        ];

        $is_request_created = LeaveRequest::create($data);

        if($is_request_created){
            return back()->with('success', 'Leave request submitted succesfully');
        }else{
            return back()->with('error', 'Your request has faild to submit!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
