<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use DB;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request) {
        auth()->user()->update($request->only('name', 'email'));
        $data = $request->input();
        $data = array_splice($data, 2);
        // dd($data);
        // remove _method and token from the data array
        DB::table('users')->where('id', auth()->user()->id)->update($data);
        return redirect()->route('profile')->with('message', 'Profile saved successfully');
    }
}
