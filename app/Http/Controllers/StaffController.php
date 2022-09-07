<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function viewStaffs(){
        $staffs = User::role('Staff')->get();
        return view('staffs.allStaffs',[
            'staffs'=>$staffs
        ]);
    }
    public function addStaff(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Staff');
        return redirect()->back()->with('success','Staff Created Successfully');
    }
    public function editStaff(Request $request)
    {
        $staff = User::find($request->id);
        $staff->name = $request->name;
        $staff->email = $request->email;
        if($request->password)
        {
            $staff->password = Hash::make($request->password);
        }
        $staff->save();
        return redirect()->back()->with('success','Staff Datails Edited Successfully');
    }
    public function deleteStaff($id)
    {
        $staff = User::find($id);
        $staff->delete();
        return redirect()->back()->with('success','Staff Deleted Successfully');
    }
}
