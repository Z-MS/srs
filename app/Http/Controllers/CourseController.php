<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CourseController extends Controller
{
    private $fields = array('title', 'code', 'department', 'faculty', 'level', 'units');
    public function show() {
        $courses = DB::table('courses')->orderBy('title', 'asc')->get();
        $faculties = DB::table('faculties')->orderBy('name', 'asc')->get();
        // fetch available faculties so we can choose what faculty the course falls under
        return view('admin.courses-page', ['courses' => $courses, 'fields' => $this->fields, 'faculties' => $faculties]);
    }

    public function create(Request $request) {
        // fetch all input, including the hidden CSRF token
        $data = $request->input();
        // remove the token from the array
        $data = array_splice($data, 1);
        $data['creator_id'] = auth()->user()->id;
        $data['created_at'] = now();

        DB::table('courses')->insert($data);
        $courses = DB::table('courses')->orderBy('title', 'asc')->get();

        return view('components.table-row', ['items' => $courses, 'fields' => $this->fields]);
    }

    public function fetchDeps(Request $request, $fac) {
        $departments = DB::table('departments')->where('faculty', $fac)->get();

        return view('components.options', ['options' => $departments]);
        // return view('components.options', ['options' => '<i>'.$request.'</i>']);
    }
}
