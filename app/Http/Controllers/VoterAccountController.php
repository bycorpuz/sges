<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\AccessLevel;
use App\Grade;
use App\Profile;
use DB;

class VoterAccountController extends Controller
{
    public function voterList(Request $request) {
        $id = $request->id;
        $search = $request->search;
        $search_grade = $request->search_grade;
        $user_repo = new User();

        if(session('school')->isElementary()) {
            $grades = Grade::where('for_elem', 1)->get();
        }
        else {
            $grades = Grade::whereNull('for_elem')->get();
        }

        if($id) {
            $voter = User::find($id);
            if($voter) {

                return view('comelec.voter.edit', [
                    'voter' => $voter,
                    'grades' => $grades,
                ]);

            }
        }

        if($search || $search_grade) {
            $user_ids = Profile::select('tbl_user_id')
                        ->where('ref_grade_level_id', 'like', '%'.$search_grade.'%')
                        ->where(function($query) use($search) {
                            $query->where('last_name', 'like', '%'.$search.'%')
                                ->orWhere('first_name', 'like', '%'.$search.'%')
                                ->orWhere('middle_name', 'like', '%'.$search.'%')
                                ->orWhere('lrn', 'like', '%'.$search.'%');
                        })
                        ->get()
                        ->toArray();

            $voters = DB::table('tbl_user')
                    ->join('tbl_profile', 'tbl_user.id', '=', 'tbl_profile.tbl_user_id')
                    ->join('ref_grade_level', 'tbl_profile.ref_grade_level_id', '=', 'ref_grade_level.id')
                    ->select('tbl_user.*', 'tbl_profile.*', 'ref_grade_level.grade')
                    ->orderBy('ref_grade_level.id', 'ASC')
                    ->orderBy('tbl_profile.section', 'ASC')
                    ->orderBy('tbl_profile.last_name', 'ASC')
                    ->where('tbl_user.ref_access_level_id', AccessLevel::VOTER)
                    ->where(function($query) use($user_ids, $search) {
                        $query->whereIn('tbl_profile.tbl_user_id', $user_ids);
                    })
                    ->paginate(15);
        }
        else {
            $voters = DB::table('tbl_user')
                    ->join('tbl_profile', 'tbl_user.id', '=', 'tbl_profile.tbl_user_id')
                    ->join('ref_grade_level', 'tbl_profile.ref_grade_level_id', '=', 'ref_grade_level.id')
                    ->select('tbl_user.*', 'tbl_profile.*', 'ref_grade_level.grade')
                    ->orderBy('ref_grade_level.id', 'ASC')
                    ->orderBy('tbl_profile.section', 'ASC')
                    ->orderBy('tbl_profile.last_name', 'ASC')
                    ->paginate(15);
        }

        return view('comelec.voter.index', [
            'voters' => $voters,
            'grades' => $grades,
            'search' => $search,
            'search_grade' => $search_grade,
            'user_repo' => $user_repo,
        ]);
    }

    public function addVoter() {
        if(session('school')->isElementary()) {
            $grades = Grade::where('for_elem', 1)->get();
        }
        else {
            // $grades = Grade::Get();
            $grades = Grade::whereNull('for_elem')->get();
        }
        
        return view('comelec.voter.add', [
            "grades" => $grades,
        ]);
    }

    public function createVoter(Request $request) {
        $lrn = $request->input('lrn');
        $last_name = trim($request->input('last_name'));
        $first_name = trim($request->input('first_name'));
        $middle_name = trim($request->input('middle_name'));
        $grade_level = $request->input('grade');
        $section = $request->input('section');


        if(strlen($lrn) > 12 || strlen($lrn) < 10) {
            return redirect()->back()->with('error', 'LRN must be 10 to 12 characters long.');
        }

        if($last_name == NULL || $first_name == NULL) {
            return redirect()->back()->with('error', 'Please complete all required fields.');
        }

        $user = User::where('username', $lrn)->first();
        // dd($user ? true : false);

        if($user) {
            return redirect()->back()->with('error', 'Voter LRN has already been used.');
        }

        $hashed = md5(md5($lrn));

        $password_salt = substr($hashed, 6, 8);
        $password = md5($lrn);

        DB::transaction(function() use ($lrn, $last_name, $first_name, $middle_name, $grade_level, $section, $password, $password_salt) {

            $user = new User();
            
            $user->username = $lrn;
            $user->password = $password;
            $user->password_salt = $password_salt;
            $user->ref_access_level_id = AccessLevel::VOTER;
            $user->created_by = session('user')->id;

            $user->save();

            $profile = new Profile();

            $profile->tbl_user_id = $user->id;
            $profile->last_name = $last_name;
            $profile->first_name = $first_name;
            $profile->middle_name = $middle_name;
            $profile->lrn = $lrn;
            $profile->ref_grade_level_id = $grade_level;
            $profile->section = $section;

            $profile->save();
        });

        return redirect()->route('voter_list')->with('success', 'New voter has been created');
    }

    

    public function updateVoter(Request $request) {
        $lrn = $request->input('lrn');
        $last_name = trim($request->input('last_name'));
        $first_name = trim($request->input('first_name'));
        $middle_name = trim($request->input('middle_name'));
        $grade_level = $request->input('grade');
        $section = $request->input('section');
        $id = $request->id;

        if(strlen($lrn) > 12 || strlen($lrn) < 10) {
            return redirect()->back()->with('error', 'LRN must be 10 to 12 characters long.');
        }

        if($last_name == NULL || $first_name == NULL) {
            return redirect()->back()->with('error', 'Please complete all required fields.');
        }

        $current_voter = User::find($id);

        if(!$current_voter) {
            return redirect()->route('voter_list');
        }

        if($current_voter->username != $lrn) {

            $user = User::where('username', $lrn)->first();
            // dd($user ? true : false);

            if($user) {
                return redirect()->back()->with('error', 'Voter LRN has already been used.');
            }
        }

        $hashed = md5(md5($lrn));

        $password_salt = substr($hashed, 6, 8);
        $password = md5($lrn);

        DB::transaction(function() use ($id, $lrn, $last_name, $first_name, $middle_name, $grade_level, $section, $password, $password_salt) {

            $user = User::find($id);
            
            $user->username = $lrn;
            $user->password = $password;
            $user->password_salt = $password_salt;
            $user->ref_access_level_id = AccessLevel::VOTER;
            $user->created_by = session('user')->id;

            $user->save();

            $profile = Profile::where('tbl_user_id', $id)->first();

            $profile->tbl_user_id = $user->id;
            $profile->last_name = $last_name;
            $profile->first_name = $first_name;
            $profile->middle_name = $middle_name;
            $profile->lrn = $lrn;
            $profile->ref_grade_level_id = $grade_level;
            $profile->section = $section;

            $profile->save();
        });

        return redirect()->route('voter_list')->with('success', 'New voter has been updated');
    }

    public function deleteVoter(Request $request) {
        $id = $request->id;

        User::find($id)->delete();
        Profile::where('tbl_user_id', $id)->delete();

        return redirect()->route('voter_list')->with('success', 'Voter has been removed');
    }

    public function uploadVoter() {
        return view('comelec.voter.upload');
    }

    public function uploadVoterList(Request $request) {
        $file = $request->file('file');

        $handle = fopen($file, "r");
        $header = true;

        $total_error = 0;
        $count = 0;

        $grade_list = array();

        if(session('school')->isElementary()) {
            $grades = Grade::select('id')->where('for_elem', 1)->get();
        }
        else {
            $grades = Grade::select('id')->whereNull('for_elem')->get();
        }
        
        foreach($grades as $grade) {
            array_push($grade_list, $grade->id);
        }

        $user_list = array();
        $profile_list = array();

        $lrns = array();

        while ($csvLine = fgetcsv($handle, 1000, ",")) {
            $error = false;

            if ($header) {
                $header = false;
            } else {
                $lrn = $csvLine[0];                
                $last_name = $csvLine[1];                
                $first_name = $csvLine[2];                
                $middle_name = $csvLine[3];                
                $grade_level = $csvLine[4];                
                $section = $csvLine[5];

                if(strlen($lrn) > 12 || strlen($lrn) < 10) {
                    $error = true;
                }

                if(!in_array($grade_level - 3, $grade_list)) {
                    $error = true;
                }
        
                if($last_name == NULL || $first_name == NULL) {
                    $error = true;
                }

                if($grade_level > 12 || $grade_level < 4) {
                    $error = true;
                }
        
        
                $user = User::where('username', $lrn)->first();
                
                if($user || in_array($lrn, $lrns)) {
                    $error = true;
                }

                $hashed = md5(md5($lrn));
        
                $password_salt = substr($hashed, 6, 8);
                $password = md5($lrn);
                
                if(!$error) {

                    array_push($user_list, [
                        'username' => $lrn,
                        'password' => $password,
                        'password_salt' => $password_salt,
                        'ref_access_level_id' => AccessLevel::VOTER,
                        'created_by' => session('user')->id,
                    ]);

                    array_push($profile_list, [
                        'last_name' => $last_name,
                        'first_name' => $first_name,
                        'middle_name' => $middle_name,
                        'lrn' => $lrn,
                        'ref_grade_level_id' => $grade_level - 3,
                        'section' => $section,
                    ]);

                    array_push($lrns, $lrn);
                }
                else {
                    $total_error++;
                }
                $count++;
            }
        }

        User::insert($user_list);
        Profile::insert($profile_list);

        DB::table('tbl_profile')
            ->join('tbl_user','tbl_user.username','=', 'tbl_profile.lrn' )
            ->where('tbl_profile.tbl_user_id', 0)
            ->update([
                'tbl_profile.tbl_user_id' => DB::raw('tbl_user.id')
            ]);

        if($total_error == 0) {
            return redirect()->route('voter_list')->with('success', 'Voters has been uploaded successfully');
        }
        elseif($total_error < $count ) {
            return redirect()->route('voter_list')->with('error', 'Few voters has been added. Please check following:<br>
                1. LRN must be 10 to 12 characters long.<br>
                2. Last Name and First Name must not be empty.<br>
                3. LRN must not be registered before uploading the CSV file.<br>
            ');
        }
        else {
            return redirect()->route('voter_list')->with('error', 'Voters has not been uploaded. please check the file before uploading.');
        }
    }

    public function asd() {
        return '<font size="72">Pero joke lang un hahahaha! #triggered</font>';
    }

    public function getVoterInfo(Request $request) {
        $voter_id = $request->voter_id;
        $voter = User::find($voter_id);
        
        if(session('school')->isElementary()) {
            $grades = Grade::where('for_elem', 1)->get();
        }
        else {
            $grades = Grade::whereNull('for_elem')->get();
        }
        
        $data = array();
        $data['profile'] = $voter->profile;

        $data['grade'] = '<option value="">--- Grade ---</option>';

        foreach($grades as $grade) {
            $data['grade'] .= '<option value="'.$grade->id.'"'.($grade->id == $voter->profile->ref_grade_level_id ? ' selected' : '').'>'.$grade->grade.'</option>';
        }

        return response()->json($data);
    }
}
