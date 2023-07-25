<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentRegisterationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function create()
    {

        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
            'password' => Hash::make($request->password),
            'profile_picture' => $file_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'user_type' => 'Student',
        ];
        // return "hello user";

        $is_user_created = User::create($data);
        $is_user_created = $is_user_created->createToken('userToken')->accessToken;

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
