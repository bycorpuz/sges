<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Position;
use App\Candidate;
use App\Ballot;
use DB;
use App\User;

class VoterController extends Controller
{
    public function index(Request $request) {

        $ballot = Ballot::where('tbl_user_id', session('user')->id)->get();

        if($ballot->count() > 0) {
            return redirect()->route('success_vote');
        }

        $user_grade = session('profile')->grade->id;

        if(session('profile')->isNotVoterRepresentative()) {
            $candidates = Candidate::whereNull('ref_grade_level_id')
                                    ->orderBy('last_name', 'ASC')
                                    ->orderBy('first_name', 'ASC')->get();
        }
        else {
            // $candidates = Candidate::where('ref_grade_level_id', $user_grade + 1)
            $candidates = Candidate::where('ref_grade_level_id', $user_grade)
                                    ->orWhereNull('ref_grade_level_id')
                                    ->orderBy('last_name', 'ASC')
                                    ->orderBy('first_name', 'ASC')->get();
        }
        $positions = Position::get();

        $ballot_list = array();

        foreach($positions as $position) {
            $ballot_list[$position->position_name] = array();
            foreach($candidates as $candidate) {
                if($position->id == $candidate->ref_position_id) {
                    array_push($ballot_list[$position->position_name], $candidate);
                }
            }
        }

        return view('voter.ballot.index', [
            'ballot_list' => $ballot_list,
            'positions' => $positions,
        ]);
    }

    public function castVote(Request $request) {
        $positions = Position::get();

        DB::transaction(function() use ($positions, $request) {
            foreach($positions as $position) {
                $value = $request->input($position->id.'_item');

                $item = new Ballot;
                $item->tbl_user_id = session('user')->id;
                $item->ref_position_id = $position->id;
                $item->tbl_candidate_id = $value;


				$user = User::find(session('user')->id);
				$user->is_voted = 'voted';
				$user->save();

                $item->save();
            }
        });

        return redirect()->route('success_vote');
    }

    public function successVote() {
        $ballot = Ballot::where('tbl_user_id', session('user')->id)->get();

        if($ballot->count() < 1) {
            return redirect()->route('voter_home');
        }

        $positions = Position::get();

        $ballot = array();

        foreach($positions as $position) {
            $ballot[$position->position_name] = Ballot::where([['tbl_user_id', session('user')->id], ['ref_position_id', $position->id]])->first()->candidate;
        }

        return view('voter.ballot.success', [
            'ballot' => $ballot,
        ]);
    }
}
