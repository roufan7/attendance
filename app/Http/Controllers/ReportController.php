<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

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
        $dates = explode('-',$request->date);
        if($request->user_id && $request->user_id == 'ALL')
        {
            $attendances = Attendance::whereDate('date','>=',$dates[0])->whereDate('date','<=',$dates[1])->get();
        }
        $response = [
            'success'=>true,
            'data'=>$attendances

        ];
        return response()->json($response);
    }
}
