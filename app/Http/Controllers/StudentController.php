<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    public function show() {
        $students = DB::table('users')->where('role', 'Student')->get();
        return view('admin.students', ['students' => $students]);
    }
}
