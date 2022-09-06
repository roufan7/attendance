<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function viewStaffs(){
        return view('staffs.allStaffs');
    }
}
