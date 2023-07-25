<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['user' => function($query) {
            $query->with('company');
        }])->get();

        $data = [
            'students' => $students
        ];
        return view('admin.students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "hello user";

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'gender' => ['required'],
        ]);
        if (!empty($request->phone)) {
            $request->validate([
                'phone' => ['unique:users,phone_no']
            ]);
        }

        if (!empty($request->cnic)) {
            $request->validate([
                'cnic' => ['unique:users,cnic']
            ]);
        }
        if (!empty($request->picture)) {
            $request->validate([
                'picture' => ['mimes:png,jpg,jpeg']
            ]);

            $file = $request['picture'];
            $file_name = 'aci-' . time() . '-' . $file->getClientOriginalName();
        } else {
            $file_name = 'avatar.png';
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone,
            'cnic' => $request->cnic,
            'password' => Hash::make('12345'),
            'profile_picture' => $file_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'user_type' => 'Student',
            'status' => 1,
        ];
        // return "hello user";

        $is_user_created = User::create($data);

        if ($is_user_created) {
            $file = $request['picture'];

            if ($file) {
                $is_file_uploaded = $file->move(public_path('student_uploads'), $file_name);
            }

            $data = [
                'user_id' => $is_user_created->id,
            ];

            $is_student_created = Student::create($data);

            if ($is_student_created) {
                return back()->with('success', 'student has registered successfully');
            } else {
                return back()->with('error', 'student has failed to register!');
            }
        } else {
            return back()->with('error', 'user has failed to create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $data = [
            'student' => $student,
        ];
        return view('admin.students.show_profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // dd($student);
        if ($student->basic_computer_knowledge == '1') {
            $basic_computer_knowledge = 'Yes';
        } else {
            $basic_computer_knowledge = 'No';
        }
        // return dd($basic_computer_knowledge);
        $data = [
            'student' => $student,
            'basic_computer_knowledge' => $basic_computer_knowledge
        ];

        return view('admin.students.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $student->user_id . ',id'],
            'phone' => ['required', 'unique:users,phone_no,' . $student->user_id . ',id'],
            'cnic' => ['required', 'unique:users,cnic,' . $student->user_id . ',id'],
            'gender' => ['required'],
        ]);
        // return ($request->all());

        $file = $request['picture'];
        $file_name = '';
        $old_file_name = '';

        if ($file) {
            $file_name = $file->getClientOriginalName();

            $file_name = 'S-' . time() . '-' . $file_name;
            $old_file_name = $student->user->profile_picture;
        } else {
            $file_name = $student->user->profile_picture;
        }

        if ($request->status) {
            $status = 1;
        } else {
            $status = 0;
        }

        // return dd($request->qualification);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone,
            'cnic' => $request->cnic,
            'password' => Hash::make('12345'),
            'profile_picture' => $file_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'user_type' => 'Student',
        ];
        // dd(User::find($student->user_id)->update($data));
        $is_user_updated = User::find($student->user_id)->update($data);

        if ($is_user_updated) {

            // $is_file_uploaded = $file->move(public_path('student_uploads'), $file_name);
            if ($file) {
                if ($old_file_name == 'avatar.png') {
                } else {
                    File::delete(public_path('student_uploads/' . $old_file_name));
                }


                $is_file_uploaded = $file->move(public_path('student_uploads'), $file_name);
                if ($is_file_uploaded) {
                    return back()->with('success', 'Student has been successfully updated');
                } else {
                    return back()->with('error', 'Student has failed to update');
                }
            }


            $data = [
                'user_id' => $student->user_id,
            ];

            $is_student_updated = Student::find($student->id)->update($data);

            if ($is_student_updated) {
                return back()->with('success', 'Student has been successfully updated');
            } else {
                return back()->with('error', 'Student has failed to update');
            }
        } else {
            return back()->with('error', 'student has failed to update');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
