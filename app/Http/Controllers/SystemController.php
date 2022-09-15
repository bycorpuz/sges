<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Ballot;
use App\Party;
use App\Candidate;
use App\Accesslevel;
use DB;

class SystemController extends Controller
{
    public function reset() {
        return view('admin.system.reset');
    }

    public function resetSystem(Request $request) {
        
        $files = glob( 'candidate/' . '*', GLOB_MARK );

        foreach($files as $file) {
            unlink($file);
        }

        $password = $request->password;

        if(session('user')->password  == md5($password)) {
            DB::transaction(function() {
                User::truncate();
                Profile::truncate();
                Ballot::truncate();
                Party::truncate();
                Candidate::truncate();

                $user = new User;

                $user->username = session('user')->username;
                $user->password = session('user')->password;
                $user->ref_access_level_id = Accesslevel::ADMIN;

                $user->save();

                $profile = new Profile;
                $profile->tbl_user_id = $user->id;
                $profile->last_name = session('profile')->last_name;
                $profile->first_name = session('profile')->first_name;
                $profile->middle_name = session('profile')->middle_name;
                $profile->nickname = session('profile')->nickname;

                $profile->save();

                $party = new Party;

                $party->party_name = 'Independent';

                $party->save();

            });

            $files = glob( 'candidate/' . '*', GLOB_MARK );

            foreach($files as $file) {
                unlink($file);
            }

            session()->flush();
            return redirect()->route('login')->with('success', 'System has been reset.');
        }
    }
}
