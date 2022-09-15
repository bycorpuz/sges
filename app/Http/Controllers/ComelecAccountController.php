<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AccessLevel;
use App\Profile;
use DB;

class ComelecAccountController extends Controller
{
    public function comelectList(Request $request) {
        $id = $request->id;
        $search = $request->s ? : '';

        if($id) {
            $user = User::find($id);
            
            if($user) {
                return view('admin.accounts.edit', [
                    'user' => $user,
                ]);
            }

            return redirect()->route('user_comelec_list');

        }

        if($search) {
            $user_ids = Profile::select('id')->where('last_name', 'like', '%'.$search.'%')
                        ->orWhere('first_name', 'like', '%'.$search.'%')->get()->toArray();

            $users = User::where('ref_access_level_id', AccessLevel::COMELEC)
                        ->where(function($query) use($user_ids, $search) {
                            $query->whereIn('id', $user_ids)
                                ->orWhere('username', 'like', '%'.$search.'%');
                        })->paginate(15);
        }
        else {
            $users = User::where('ref_access_level_id', AccessLevel::COMELEC)->paginate(15);
        }

        return view('admin.accounts.index', [
            'users' => $users,
            'search' => $search,
        ]);
    }
    
    public function addComelecAccount() {
        return view('admin.accounts.create');
    }

    public function createComelecAccount(Request $request) {
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));
        $last_name = trim($request->input('last_name'));
        $first_name = trim($request->input('first_name'));
        $middle_name = trim($request->input('middle_name'));

        $user = User::where('username', $username)->first();

        if($user) {
            return redirect()->back()->with('error', 'Username has already been used');
        }
        
        $validate = trim($last_name) == NULL || trim($first_name) == NULL || trim($username) == NULL;
        
        if($validate) {
            return redirect()->back()->with('error', 'Please fill up the required fields.');
        }

        DB::transaction(function() use($username, $password, $last_name, $first_name, $middle_name){
            $user = new User();
            
            $user->username = $username;
            $user->password = md5($password);
            $user->ref_access_level_id = AccessLevel::COMELEC;
            $user->created_by = session('user')->id;
            $user->save();

            $profile = new Profile();
            $profile->tbl_user_id = $user->id;
            $profile->last_name = $last_name;
            $profile->first_name = $first_name;
            $profile->middle_name = $middle_name;
            $profile->save();
        });

        return redirect()->route('user_comelec_list')->with('success', 'Account has been created.');
    }

    function resetComelecAccount(Request $request) {
        $id = $request->id;

        $user = User::find($id);
        
        if(!$user) {
            return redirect()->route('user_comelec_list');
        }

        $user->password = md5($user->username);
        $user->save();

        return redirect()->route('user_comelec_list')->with('success', 'Account has been reset.');
    }

    function updateComelectAccount(Request $request) {
        $username = trim($request->input('username'));
        $password = trim($request->input('password'));
        $last_name = trim($request->input('last_name'));
        $first_name = trim($request->input('first_name'));
        $middle_name = trim($request->input('middle_name'));
        $id = $request->id;

        $user = User::find($id);

        if($user && $user->username != $username) {
            $user_exists = User::where('username', $username)->first();

            if($user_exists) {
                return redirect()->back()->with('error', 'Username has already been used');
            }
        }

        if(!$user) {
            return redirect()->route('user_comelec_list');
        }
            
        $validate = trim($last_name) == NULL || trim($first_name) == NULL || trim($username) == NULL;
        
        if($validate) {
            return redirect()->back()->with('error', 'Please fill up the required fields.');
        }

        DB::transaction(function() use($id, $username, $password, $last_name, $first_name, $middle_name, $user){
            
            $user->username = $username;
            if($password) {
                $user->password = md5($password);
            }
            $user->save();

            $profile = Profile::where('tbl_user_id', $id)->first();
            $profile->last_name = $last_name;
            $profile->first_name = $first_name;
            $profile->middle_name = $middle_name;
            $profile->save();
        });

        return redirect()->route('user_comelec_list')->with('success', 'Account has been updated.');
    }

    public function deleteComelectAccount(Request $request) {
        $id = $request->id;

        $user = User::find($id)->delete();
        
        return redirect()->route('user_comelec_list')->with('success', 'Account has been deleted.');

    }

    function getComelectAccountInfo(Request $request) {
        $user_id = $request->user_id;
        $data = array();
        $data['user'] = User::find($user_id);
        $data['profile'] = $data['user']->profile;

        return response()->json($data);
        
    }
}
