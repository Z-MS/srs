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
        $data = array('name' => $request->name, 'code' => $request->code, 'creator_id' => auth()->user()->id);
        DB::table('faculty')->insert($data);
        $faculties = DB::table('faculty')->orderBy('name', 'asc')->get();

        return view('admin.processes.faculties', ['faculties' => $faculties]);
    }
}
