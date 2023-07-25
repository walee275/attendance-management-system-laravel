<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiHandleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Laravel\Sanctum\PersonalAccessToken;

Route::get('/token', function () {

$tokenExists = PersonalAccessToken::where('tokenable_id', 1)->first();
if($tokenExists){
    return $tokenExists->token;
}
// return $tokenExists;
})->name('main');





Route::controller(ApiHandleController::class)->group(function(){
    // Route::get('/leave_requests', 'leave_requests')->name('leave_requests');
    Route::get('/destroy_token', 'destroy_token')->name('destroy_token');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {



    return 'hello';

});

Route::controller(ApiHandleController::class)->middleware(['auth:sanctum'])->group(function () {
    // Route::get('api/login', 'api_login')->name('api.login');



    Route::get('/company/registered/users', 'company_users')->name('company.users');
    Route::get('/students', 'students')->name('students');
    // Route::get('/companies', 'companies')->name('companies');
    Route::get('/attendances/{from}/{to}', 'attendances')->name('attendances');
    Route::get('/attendances/{from}/{to}/{student}', 'single_student_attendances')->name('single.student.attendances');

    Route::get('/attendances/create', 'attendances_create')->name('attendances.create');
    Route::get('update/student/attendance', 'update_student_attendance')->name('update.student.attendance');
    Route::get('destroy/student/attendance/{attendance}', 'destroy_attendance')->name('destroy.attendance');
    Route::get('/leave_requests', 'leave_requests')->name('leave_requests');

    Route::get('requests/{status}', 'specific_leave_requests')->name('specific.leave.requests');


    Route::get('approve/leaverequests/{leave_request}', 'approve_leave_request')->name('approve.leave_requests');
    Route::get('/leave_requests/{leave_request}/reject', 'reject_leave_request')->name('reject.leave_requests');

});
