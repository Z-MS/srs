<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FacultyController extends Controller
{
    public function show() {
        $faculties = DB::table('faculty')->orderBy('name', 'asc')->get();
        // dd($faculties);
        return view('admin.faculties', ['faculties' => $faculties]);
    }

    public function create(Request $request) {
        $data = $request->input();
        $data = array_splice($data, 1);
        $data['creator_id'] = auth()->user()->id;
        $data['created_at'] = now();

        DB::table('faculty')->insert($data);
        $faculties = DB::table('faculty')->orderBy('name', 'asc')->get();

        return view('admin.processes.faculties', ['faculties' => $faculties]);
    }

    public function showDetails(Request $request, $name) {
        $faculty = DB::table('faculty')->where('name', $name)->get()[0];
        // dd($faculty);
        return view('admin.faculty-details', ['faculty' => $faculty]);
    }
}
