<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StaffController extends Controller
{
    public function show() {
        $staff = DB::table('users')->where('role', 'Staff')->get();
        return view('admin.staff', ['staff' => $staff]);
    }
}
