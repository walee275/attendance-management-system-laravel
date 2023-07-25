<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Arr;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ApiHandleController extends Controller
{

    // public function auth_user(){
    //     $user = '';
    //     return $user = Auth::user()->name;
    // }

    public function api_login(Request $request)
    {
        // echo json_encode($request->all());
        $request = $request->all();
        $credentials = Arr::except($request, ['_token']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('userToken');

            $data = [
                'user' => $user,
                'token' => $token->plainTextToken,
            ];
            echo json_encode($data);
        }else{
            echo json_encode(['error' => 'Invalid combination!']);
        }
        // Auth::attempt(array_except('_token'));

    }

    public function destroy_token(Request $request)
{
        $user = $request->all();
        // return json_encode($user['user']['id']);
        $token_destroyed = PersonalAccessToken::where('tokenable_id', $user['user']['id'])->delete();
        if($token_destroyed){
            return json_encode(true);
        }else{
            return json_encode(false);

        }
}








    public function company_users(Request $request, Company $company)
    {

        $users = User::with('company')->where('company_id', $request->company)->get();

        $data = [
            'users' => $users,
        ];
        $company = $request->company;
        // dd($users);
        echo json_encode($users);
    }

    public function companies()
    {
        $companies = Company::all();

        $data = [
            'companies' => $companies,
        ];

        echo json_encode($data);
    }

    public function students()
    {
        $students = Student::with('user')->get();

        $data = [
            'students' => $students,
        ];

        echo json_encode($data);
    }

    public function attendances($from, $to)
    {
        $from_date = $from;
        $to_date = $to;

        if (Carbon::parse($from_date)->gt(Carbon::parse($to_date))) {
            echo json_encode(['error' => 'From date should be greater then or equal to the other one! ']);
        } else {
            $attendances = Attendance::with('student')
                ->whereBetween('date', [$from_date, $to_date])->get();

            if (!$attendances) {
                return json_encode(['error' => 'No attendance Found!']);
            }
            $output = '';
            foreach ($attendances as $attendance) {
                // $attendance = [
                //     'student_id' => $attendance->student_id,
                //     'date' => $attendance->attendance->date
                // ];
                $status = "";
                if ($attendance->status == 1) {
                    $status = '<span class="badge bg-success">Present</span>';
                } elseif ($attendance->status == 2) {
                    $status = '<span class="badge bg-warning">Leave</span>';
                } else {
                    $status = '<span class="badge bg-danger">Absent</span>';
                }
                $output .= '
                <tr>
                <td>' . $attendance->date->format('d-M-Y') . '</td>
                <td>' . $attendance->student->user->name . '</td>
                <td>' . $status . '</td>
                <td><a class="btn btn-primary" href="student/attendance/' . $attendance->id . '/edit"> Edit </a>
                <a class="btn btn-danger" href="destroy/attendance/' . $attendance->id .'"> Delete </a></td>
                </tr>
                ';
            }
            echo json_encode($output);
        }
    }



    public function attendances_create(Request $request)
    {

        $request = $request['request'];
        // echo json_encode('hello');
        $date = ($request['date']);
        $attendance_already_exist = Attendance::where('date', $date)->first();
        if (empty($date)) {
            return json_encode(['error' => 'Date is required!']);
        } elseif ($attendance_already_exist) {
            return json_encode(['error' => 'Attendance for this date already exist!']);
        } else {
            $students = Arr::except($request, ['_token', 'date']);
            $count = 0;
            // return json_encode($students);


            foreach ($students as $key => $value) {
                $data = [
                    'student_id' => $key,
                    'date' => $date,
                    'status' => $value,
                ];
                if (Attendance::create($data)) {
                    $count++;
                }
            }
            // return json_encode($count);
            // dd($count, $students);
            if ($count == count($students)) {
                return json_encode(['success' => 'Attendance has been successfully added!']);
            } else {
                return json_encode(['error' => 'Attendance coun details has failed to add!']);
            }
        }

        // // echo json_encode($request->errors());

    }


    public function single_student_attendances($from, $to, $student)
    {
        $from_date = $from;
        $to_date = $to;
        $student_id = $student;

        if (Carbon::parse($from_date)->gt(Carbon::parse($to_date))) {
            echo json_encode(['error' => 'From date should be greater then or equal to the other one! ']);
        } else {
            $attendances = Attendance::with('student')
                ->where('student_id', $student_id)
                ->whereBetween('date', [$from_date, $to_date])->get();

            if (!$attendances) {
                return json_encode(['error' => 'No attendance Found!']);
            }
            $output = '';
            foreach ($attendances as $attendance) {
                // $attendance = [
                //     'student_id' => $attendance->student_id,
                //     'date' => $attendance->attendance->date
                // ];
                $status = "";
                if ($attendance->status == 1) {
                    $status = '<span class="badge bg-success">Present</span>';
                } elseif ($attendance->status == 2) {
                    $status = '<span class="badge bg-warning">Leave</span>';
                } else {
                    $status = '<span class="badge bg-danger">Absent</span>';
                }
                $output .= '
                <tr>
                <td>' . $attendance->date->format('d-M-Y') . '</td>
                <td>' . $attendance->student->user->name . '</td>
                <td>' . $status . '</td>
                <td><a class="btn btn-primary" href="student/attendance/' . $attendance->id . '/edit"> Edit </a>
                <a class="btn btn-danger" href="destroy/attendance/' . $attendance->id .'"> Delete </a></td>
                </tr>
                ';
            }
            echo json_encode($output);
        }
    }

    public function update_student_attendance(Request $request)
    {

        // echo json_encode($request->all());
        $data = [
            'status' => $request->status,
        ];
        if (Attendance::find($request->attendance)->update($data)) {
            return json_encode(['success' => 'Attendance has been successfully updated!']);
        } else {
            return json_encode(['error' =>  'Attendance coun details has failed to update!']);
        }
    }



    public function destroy_attendance(Attendance $attendance){

        $is_attendance_destroyed = Attendance::find($attendance->id)->delete();

        if ($is_attendance_destroyed) {
            return json_encode(['success' => 'Attendance has been successfully destroyed!']);
        } else {
            return json_encode(['error' =>  'Attendance coun details has failed to destroy!']);
        }
    }

    public function leave_requests()
    {
        $leave_requests = LeaveRequest::with('student.user')->get();

        $data = [
            'leave_requests' => $leave_requests,
        ];
        dd($leave_requests);
        echo json_encode($data);
    }

    public function specific_leave_requests($status){


        $leave_requests = LeaveRequest::with('student')
            ->where('status', $status)->get();
        $output = '';
        $status = '';
        $i = 1;
        foreach ($leave_requests as $leave_request) {

            if ($leave_request->status == 0) {
                $status = '<span class="label bg-primary text-bold text-white"> Pending </span>';
            } elseif ($leave_request->status == 1) {
                $status = '<span class="label bg-success text-bold text-white"> Approved </span>';
            } else {
                $status = '<span class="label bg-danger text-bold text-white> Rejected </span>';
            }
            $output .= '<tr>
                <td>' . $i . '</td>
                <td>' . $leave_request->student->user->name . '</td>
                <td>' . $leave_request->student->user->email . '</td>
                <td>' . $leave_request->reason . '</td>
                <td>' . $leave_request->date->format('d-m-Y') . '</td>
                <td>' . $status . '</td>
                <td><a href="'.route('student.approve.leave.request', $leave_request).'" class="btn btn-success" >Approve </a>
                <a href="'.route('student.approve.leave.request', $leave_request).'" class="btn btn-danger" id="reject-btn">Reject</a>
                </td>
                </tr>';
            $i++;
        }
        echo json_encode($output);
    }


    public function approve_leave_request($leave_request)
    {
        // return json_encode($leave_request);

        // // dd($leave_request);
        // $status = 1;

        $leave_request = LeaveRequest::where('id', $leave_request)->first();
        $data = [
            'status' => 1,
        ];

        $is_leave_approved = LeaveRequest::find($leave_request->id)->update($data);
        // return json_encode($leave_request);
        if ($is_leave_approved) {
            $attendance = Attendance::where([
                ['student_id', $leave_request->student_id],
                ['date', $leave_request->date],
            ])->first();
            if ($attendance) {
                $data = [
                    'status' => 2,
                ];
                $is_attendance_updated = Attendance::find($attendance->id)->update($data);

                if ($is_attendance_updated) {
                    return json_encode(['success' => 'Request approved successfully']);
                } else {
                    return json_encode(['error'=> 'Request has failed to approve!']);
                }
            } else {

                $data = [
                    'student_id' => $leave_request->student_id,
                    'date' => $leave_request->date,
                    'status' => 2,
                ];
                $is_attendance_created = Attendance::create($data);

                if ($is_attendance_created) {
                    return json_encode(['success'=> 'Request approved successfully']);
                } else {
                    return json_encode(['error'=> 'Request has failed to approve!']);
                }
            }
        } else {
            return json_encode(['error'=> 'Request has failed to approve!']);
        }
    }

    public function reject_leave_request($leave_request){
        $status = 2;

        $data = [
            'status' => $status,
        ];
        $is_leave_approved = LeaveRequest::find($leave_request)->update($data);

        if ($is_leave_approved) {
            return json_encode(['success' => 'Request Rejected successfully']);
        } else {
            return json_encode(['error' => 'Request has failed to Reject!']);
        }
    }
}
