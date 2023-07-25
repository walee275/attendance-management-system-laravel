<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\AttendanceDetails;
use App\Models\LeaveRequest;

class AdminDynamicController extends Controller
{


    public function fetch_attendances()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        if (Carbon::parse($from_date)->gt(Carbon::parse($to_date))) {
            echo json_encode(['error' => 'From date should be greater then or equal to the otherone! ']);
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
                <td><a class="btn btn-primary" href="' . route('admin.student.attendance.edit', $attendance) . '"> Edit </a>
                <a class="btn btn-danger" href="' . route('admin.students.attendance.destroy', $attendance) . '"> Delete </a> </td>
                </tr>
                ';
            }
            echo json_encode($output);
        }
    }

    public function fetch_single_student_attendances()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $student_id = $data['studentId'];

        if (Carbon::parse($from_date)->gt(Carbon::parse($to_date))) {
            echo json_encode(['error' => 'From date should be greater then or equal to the otherone! ']);
        } else {
            $attendances = Attendance::with('student')
                ->where('student_id', $student_id)
                ->whereBetween('date', [$from_date, $to_date])->get();


            $total_presents = 0;
            $total_absenties = 0;
            $total_leaves = 0;
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
                    $total_presents++;
                    $status = '<span class="badge bg-success">Present</span>';
                } elseif ($attendance->status == 2) {
                    $total_leaves++;
                    $status = '<span class="badge bg-warning">Leave</span>';
                } else {
                    $total_absenties++;
                    $status = '<span class="badge bg-danger">Absent</span>';
                }
                $output .= '
                <tr>
                <td>' . $attendance->date->format('d-M-Y') . '</td>
                <td>' . $attendance->student->user->name . '</td>
                <td>' . $status . '</td>
                <td><a class="btn btn-primary" href="' . route('admin.student.attendance.edit', $attendance) . '"> Edit </a>
                <a class="btn btn-danger" href="' . route('admin.students.attendance.destroy', $attendance) . '"> Delete </a> </td>
                </tr>
                ';
            }
            $grade = '';
            if ($total_presents > 10 && $total_presents < 16) {
                $grade = '<td class="bg-warning text-white">D</td>';
            }elseif ($total_presents > 16 && $total_presents < 21) {
                $grade = '<td class="bg-primary text-white">C</td>';
            }elseif ($total_presents > 20 && $total_presents < 26) {
                $grade = '<td class="bg-info text-white">B</td>';
            }elseif ($total_presents > 25) {
                $grade = '<td class="bg-success text-white">A</td>';
            }elseif ($total_presents < 10) {
                $grade = '<td class="bg-danger text-white">F</td>';
            }


            $output .= '<tr> <th>Total Presents</th>
            <th>Total Absenties</th>
            <th>Total Leaves</th>
            <th>Grades</th>  </tr>
            <tr> <td>' . $total_presents . '</td>
            <td>' . $total_absenties . '</td>
            <td>' . $total_leaves . '</td>
            '.$grade .' </tr>';

            echo json_encode($output);
        }
    }



    public function fetch_leave_requests()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];


        $leave_requests = LeaveRequest::with('student')
            ->whereBetween('date', [$from_date, $to_date])->get();
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
                <td><a href="'.route('admin.student.approve.leave.request', $leave_request).'" class="btn btn-success" >Approve </a>
                <a href="'.route('admin.student.reject.leave.request', $leave_request).'" class="btn btn-danger" id="reject-btn">Reject</a>
                </td>
                </tr>';
            $i++;
        }
        echo json_encode($output);
    }



}
