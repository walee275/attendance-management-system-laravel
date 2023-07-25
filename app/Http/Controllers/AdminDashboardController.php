<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function show() {

        $data =[
            'admin' => Auth::user(),
            // 'check' => Admin::with('role'),
        ];

        // dd($data);
        return view('admin.profile.show', $data);
    }


    public function edit(Admin $admin ) {
        // $admin = Admin::with('user')->where('id',$admin->id)->get();

        $data = [
            'admin' => $admin,
        ];
        // dd($admin);
        return view('admin.profile.edit', $data);
    }

    public function update(Request $request, Admin $admin ) {

        // $admin = Admin::with('user')->where('id',$admin->id)->get();
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'dob' => ['required'],
            'qualification' => ['required'],
            'gender' => ['required'],
        ]);

        $data = [
            'admin' => $admin,
        ];
        // dd($admin);
        return view('admin.profile.edit', $data);
    }
}
