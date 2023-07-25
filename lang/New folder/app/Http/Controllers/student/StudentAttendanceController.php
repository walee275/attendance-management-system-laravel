<?php

namespace App\Http\Controllers\student;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'attendances' => Attendance::with('student')->where('student_id', Auth::user()->student->id)->get()
        ];
        return view('students.attendance.index', $data);
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
        return view('students.attendance.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        // dd($request->all());

        $request->validate([
            'date' => [
                'required',
                Rule::unique('attendances')->where(fn ($query) => $query->where([
                    ['student_id', $student->id],
                    ['date', $request->date],
                ]))
            ],
            'status' => ['required'],
        ], [
            'date.unique' => 'Attendance for this date already exist!'
        ]);

        if($request->status){
            $status = 1;
        } else{
            $status = 0;
        }

        $data = [
            'student_id' => $student->id,
            'date' => $request->date,
            'status' => $status,
        ];

        $is_attendance_created = Attendance::create($data);

        if($is_attendance_created){
            return back()->with('success', 'Attendance marked succesfully');
        }else{
            return back()->with('error', 'Attendance has faild to marks!');
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
