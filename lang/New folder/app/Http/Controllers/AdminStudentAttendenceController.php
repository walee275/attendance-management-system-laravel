<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\AttendanceDetails;

class AdminStudentAttendenceController extends Controller
{


    public function index()
    {


        return view('admin.students.attendances.index');
    }

    public function single_attendance_index()
    {
        $data = [
            'students' => Student::with('user')->get()
        ];

        return view('admin.students.attendances.single_attendance_index', $data);
    }

    public function create()
    {

        $data = [
            'students' => Student::with('user')->get(),
        ];

        return view('admin.students.attendances.create', $data);
    }



    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'date' => [
                'required',
                Rule::unique('attendances')->where(fn ($query) => $query->where([
                    ['date', $request->date],
                ]))
            ],
        ], [
            'date.unique' => 'Attendance for this date already exist!'
        ]);

        $students = $request->except('_token', 'date');
        $count = 0;

        foreach ($students as $key => $value) {
                $data = [
                    'student_id' => $key,
                    'date' => $request->date,
                    'status' => $value,
                ];
                if (Attendance::create($data)) {
                $count++ ;
                }
            }
                // dd($count, $students);
                if ($count == count($students)) {
                    return back()->with('success', 'Attendance has been successfully added!');
                } else {
                    return back()->with('error', 'Attendance coun details has failed to add!');
                }

        }

    public function edit(Attendance $attendance)
    {

        $data = [
            'attendance' => $attendance
        ];
        // dd($attendance);
        return view('admin.students.attendances.edit', $data);
    }




    public function update(Request $request, Attendance $attendance)
    {


                $data = [
                    'student_id' => $attendance->student_id,
                    'status' => $request->status,
                ];
                if (Attendance::find($attendance->id)->update($data)) {
                    return back()->with('success', 'Attendance has been successfully updated!');

                }else {
                    return back()->with('error', 'Attendance coun details has failed to update!');
                }

    }


    public function destroy(Attendance $attendance)
    {

        $is_attendance_deleted = Attendance::find($attendance->id)->delete();

        if ($is_attendance_deleted) {
            return back()->with('success', 'Attendance has been successfully deleted!');
        }
        return back()->with('error', 'Attendance has failed to delete!');
    }
}
