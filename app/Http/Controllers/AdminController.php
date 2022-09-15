<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AccessLevel;
use App\Profile;
use DB;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function updateProfile(Request $request) {
        $user = session('user');
        $profile = session('profile');

        $username = trim($request->username);
        $password = $request->password;
        $last_name = trim($request->last_name);
        $first_name = trim($request->first_name);
        $middle_name = trim($request->middle_name);

        $validation = $username == '' || $last_name == '' || $first_name == '';

        if($validation) {
            return redirect()->route('admin_home')->with('error', 'Please enter all required fields.');
        }
        
        DB::transaction(function() use($user, $profile, $username, $password, $last_name, $first_name, $middle_name) {
            $user->username = $username;

            if($password) {
                $user->password = md5($password);
            }

            $user->save();
    
            $profile->last_name = $last_name;
            $profile->first_name = $first_name;
            $profile->middle_name = $middle_name;

            $profile->save();

        });

        return redirect()->route('admin_home')->with('success', 'Profile has been updated.');
    }
}
