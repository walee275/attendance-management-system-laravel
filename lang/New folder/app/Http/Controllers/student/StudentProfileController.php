<?php

namespace App\Http\Controllers\student;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $data = [
            'student' => $student,
        ];
        return view('students.show_profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {


        $data = [
            'student' => $student,
        ];

        return view('students.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
                    return back()->with('error', 'Student has failed to update');
                }
            }
        } else {
            return back()->with('error', 'student has failed to update');
        }
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
