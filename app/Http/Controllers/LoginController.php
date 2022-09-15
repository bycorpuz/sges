<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AccessLevel;
use App\School;

class LoginController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function login(Request $request) {
        $username = $request->input('username');

        $user = User::where('username', $username)->first();
        
        if($user) {
            if($user->accesslevel->id != AccessLevel::VOTER) {
                $password = md5($request->input('password'));
                if($user->password == $password) {
                    session([
                        'user' => $user,
                        'access_level' => $user->accesslevel,
                        'profile' => $user->profile,
                        'school' => School::first(),

                    ]);

                    return redirect()->route($user->accesslevel->access_level.'_home');
                }
            }
            else {
                $password_match = $user->generateVoterPassword() == $request->input('password');
                if($password_match) {
                    session([
                        'user' => $user,
                        'access_level' => $user->accesslevel,
                        'profile' => $user->profile,
                        'school' => School::first(),
                    ]);
                    
                    return redirect()->route($user->accesslevel->access_level.'_home');
                }
            }
        }

        return redirect()->route('login')->with('error', 'Invalid Username and Password');
    }

    public function logout() {
        session()->flush();
        return redirect()->route('login');
    }
}
