<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class AdminLeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave_requests = LeaveRequest::with('student')->get();

        $data = [
            'leave_requests' => $leave_requests,
        ];
        return view('admin.students.leave_requests.index', $data);
    }

    public function get(Request $request)
    {
        // dd($request->all());

        $leave_requests = LeaveRequest::with('student')->where('status', $request->status)->get();

        $data = [
            'leave_requests' => $leave_requests,
        ];
        return view('admin.students.leave_requests.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function approve_leave_request(LeaveRequest $leave_request)
    {

        // dd($leave_request);
        $status = 1;

        $data = [
            'status' => $status,
        ];
        $is_leave_approved = LeaveRequest::find($leave_request->id)->update($data);

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
                    return back()->with('success', 'Request approved successfully');
                } else {
                    return back()->with('error', 'Request has failed to approve!');
                }
            } else {

                $data = [
                    'student_id' => $leave_request->student_id,
                    'date' => $leave_request->date,
                    'status' => 2,
                ];
                $is_attendance_created = Attendance::create($data);

                if ($is_attendance_created) {
                    return back()->with('success', 'Request approved successfully');
                } else {
                    return back()->with('error', 'Request has failed to approve!');
                }
            }
        } else {
            return back()->with('error', 'Request has failed to approve!');
        }
    }

    public function reject_leave_request(LeaveRequest $leave_request)
    {

        // dd($leave_request);
        $status = 2;

        $data = [
            'status' => $status,
        ];
        $is_leave_approved = LeaveRequest::find($leave_request->id)->update($data);

        if ($is_leave_approved) {
            return back()->with('success', 'Request Rejected successfully');
        } else {
            return back()->with('error', 'Request has failed to Reject!');
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
