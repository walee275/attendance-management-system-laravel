<?php

use App\Http\Controllers\AdminCompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\StudentController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\AdminDynamicController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLeaveRequestController;
use App\Http\Controllers\AdminStudentDashboardController;
use App\Http\Controllers\AdminStudentAttendenceController;
use App\Http\Controllers\student\StudentProfileController;
use App\Http\Controllers\student\StudentDashboardController;
use App\Http\Controllers\student\StudentAttendanceController;
use App\Http\Controllers\student\StudentLeaveRequestController;
use App\Http\Controllers\auth\StudentRegisterationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(LoginController::class)->middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/', 'view')->name('home');
    // Route::get('/', 'view')->name('home');
    Route::get('/login', 'view')->name('login');
    Route::post('/login', 'login');
});

Route::controller(StudentRegisterationController::class)->middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store');
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');





Route::prefix('admin')->name('admin.')->middleware(Authenticate::class)->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::controller(AdminStudentAttendenceController::class)->group(function () {
        Route::get('students/attendances', 'index')->name('students.attendance');
        Route::get('student/attendances/show', 'single_attendance_index')->name('single.student.attendances');

        Route::get('student/attendance/create', 'create')->name('students.attendance.create');
        Route::post('student/attendance/create', 'store');

        Route::get('student/attendances/{attendance}/edit', 'edit')->name('student.attendance.edit');
        Route::post('student/attendances/{attendance}/edit', 'update');

        Route::get('students/{attendance}/attendance/destroy', 'destroy')->name('students.attendance.destroy');


        Route::controller(AdminStudentController::class)->group(function () {
            Route::get('students', 'index')->name('students');
            Route::get('student/add', 'create')->name('student.create');
            Route::post('student/add', 'store');
            Route::get('student/{student}/profile', 'show')->name('student.profile');
            Route::get('edit/{student}/student', 'edit')->name('student.edit');
            Route::post('edit/{student}/student', 'update');
        });

        Route::controller(AdminLeaveRequestController::class)->group(function () {
            Route::get('students/leave/requests', 'index')->name('students.leave.requests');
            Route::post('students/leave/requests', 'get');
            // Route::Post('students//leave/requests/add', 'store')->name('students.leave.requests');
            Route::get('student/leave/requests/{leave_request}/approve', 'approve_leave_request')->name('student.approve.leave.request');
            Route::get('student/leave/requests/{leave_request}/reject', 'reject_leave_request')->name('student.reject.leave.request');
            Route::get('students/leaverequests', 'destroy')->name('students.leave.request.destroy');
        });

        Route::controller(AdminCompanyController::class)->group(function () {
            Route::get('companies', 'index')->name('companies');
            Route::get('company/add', 'create')->name('company.create');
            Route::post('company/add', 'store');
            Route::get('company/{company}/profile', 'show')->name('company.profile');
            Route::get('edit/{company}/company', 'edit')->name('company.edit');
            Route::post('edit/{company}/company', 'update');
            Route::get('company/{company}/destroy', 'destroy')->name('company.destroy');

        });



        Route::controller(AdminDynamicController::class)->group(function () {
            Route::post('fetch/attendance', 'fetch_attendances')->name('fetch.attendances');
            Route::post('fetch/student/attendances', 'fetch_single_student_attendances')->name('fetch.single.student.attendances');

            Route::post('fetch/leave/requests', 'fetch_leave_requests')->name('fetch.leave.requests');
        });

    });
});

Route::prefix('student')->name('student.')->middleware(Authenticate::class)->group(function () {



    Route::controller(StudentDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });


    Route::controller(StudentProfileController::class)->group(function () {
        Route::get('student/{student}/profile', 'show')->name('profile');
        Route::get('edit/{student}/student', 'edit')->name('edit');
        Route::post('edit/{student}/student', 'update');
    });

    Route::controller(StudentAttendanceController::class)->group(function () {

        Route::get('/attendances', 'index')->name('attendances');
        Route::get('/attendance/{student}/add', 'create')->name('attendance.create');
        Route::post('/attendance/{student}/add', 'store');
    });

    Route::controller(StudentLeaveRequestController::class)->group(function () {
            Route::get('/leave/request/{student}/index', 'index')->name('leave.requests.index');
            Route::get('/leave/request/{student}/add', 'create')->name('leave.request.create');
            Route::post('/leave/request/{student}/add', 'store');
        }
    );
});




Route::get('/main', function () {
    return view('layouts.main');
})->name('main');
