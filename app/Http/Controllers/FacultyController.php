<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FacultyController extends Controller
{
    // TODO: ADD ERROR CHECKING FOR THESE OPERATIONS
    // ON DELETE CASCADE FOR FACULTY-DEPARTMENT
    public function show() {
        $faculties = DB::table('faculties')->orderBy('name', 'asc')->get();
        // dd($faculties);
        return view('admin.faculties', ['faculties' => $faculties]);
    }

    public function create(Request $request) {
        // fetch all input, including the hidden CSRF token
        $data = $request->input();
        // remove the token from the array
        $data = array_splice($data, 1);
        $data['creator_id'] = auth()->user()->id;
        $data['created_at'] = now();

        DB::table('faculties')->insert($data);
        $faculties = DB::table('faculties')->orderBy('name', 'asc')->get();

        return view('admin.processes.faculties', ['faculties' => $faculties]);
    }

    public function update(Request $request) {
        // similar to 'create' above, but this request includes the 'PUT' method as a property
        $data = $request->input();
        $data = array_splice($data, 2);
        $data['updated_by'] = auth()->user()->id;
        $data['updated_at'] = now();
        // update, then fetch modified data
        DB::table('faculties')->where('name', $request->name)->update($data);

        $faculty = DB::table('faculties')->where('name', $request->name)->first();
        $departments = DB::table('departments')->where('faculty', $faculty->code)->get();
        
        return view('admin.faculty-details', ['faculty' => $faculty, 'items' => $departments, 'fields' => ['name', 'code']]);
    
    }

    public function destroy(Request $request, $name) {
        $delFac = DB::table('faculties')->where('name', $name)->delete();
        $faculties;
        if($delFac) {
            $faculties = DB::table('faculties')->orderBy('name', 'asc')->get();
        } else {
            $faculties = DB::table('faculties')->get();
        }
 
        return view('admin.processes.faculties', ['faculties' => $faculties]);
    }

    public function showDetails(Request $request, $name) {
        $faculty = DB::table('faculties')->where('name', $name)->first();
        // $faculties = DB::table('faculties')->orderBy('name', 'asc')->get();
        // the faculty code is stored in the departments table as a foreign key
        $departments = DB::table('departments')->where('faculty', $faculty->code)->get();
        
        return view('admin.faculty-details', ['faculty' => $faculty, 'items' => $departments, 'fields' => ['name', 'code']]);
    }

    /* public function showDetailsHelper($name) {
        $faculty = DB::table('faculties')->where('name', $request->name)->first();
        $departments = DB::table('departments')->where('faculty', $faculty->code)->get();
        
        return view('admin.faculty-details', ['faculty' => $faculty, 'items' => $departments, 'fields' => ['name', 'code']]);
    } */
}
