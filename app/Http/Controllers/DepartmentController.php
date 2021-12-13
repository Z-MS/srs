<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DepartmentController extends Controller
{
    public function create(Request $request) {
        // fetch all input, including the hidden CSRF token
        $data = $request->input();
        // remove the token from the array
        $data = array_splice($data, 1);
        $data['creator_id'] = auth()->user()->id;
        $data['created_at'] = now();

        DB::table('departments')->insert($data);
        $departments = DB::table('departments')->where('faculty', $request->faculty)->get();

        return view('components.table-row', ['items' => $departments, 'fields' => ['name', 'code']]);
    }
}
