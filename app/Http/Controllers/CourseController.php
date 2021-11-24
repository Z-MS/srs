<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CourseController extends Controller
{
    public function show() {
        $courses = DB::table('courses')->get();
        return view('admin.courses', ['courses' => $courses]);
    }
}
