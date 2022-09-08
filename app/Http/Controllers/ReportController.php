<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function viewReportPage()
    {
        $staffs = User::role('Staff')->get();
        return view('reports.viewAttendanceReport',[
            'staffs' => $staffs
        ]);
    }
    public function getReportData(Request $request)
    {
        $dates = explode('-', $request->date);
        if ($request->user_id && $request->user_id == 'ALL') {
            $attendances = Attendance::where('date', '>=', Carbon::parse($dates[0]))->where('date', '<=', Carbon::parse($dates[1]))->whereHas('user', function ($q) {
                $q->role('Staff');
            })->with('user')->get();
            $response = [
                'success' => true,
                'data' => $attendances

            ];
        } elseif ($request->user_id) {
            $attendances = Attendance::where('date', '>=', Carbon::parse($dates[0]))->where('date', '<=', Carbon::parse($dates[1]))->whereHas('user', function ($q) {
                $q->role('Staff');
            })->where('user_id', $request->user_id)->with('user')->get();
            $response = [
                'success' => true,
                'data' => $attendances

            ];
        } else {
            $response = [
                'success' => false,

            ];
        }
        return response()->json($response);
    }
}
