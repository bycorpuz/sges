<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\VoterListExport;
use App\User;
use App\AccessLevel;
use App\Candidate;
use App\Position;
use App\Ballot;
use App\School;
use App\Region;
use App\Division;
use App\Grade;
use DB;

class PdfController extends Controller
{
	public function printPDF()
    {
		return Excel::download(new VoterListExport, 'Voter List.xlsx');
    }
	
	public function votedPDF()
    {
	   //$user = USER::where('ref_access_level_id',accesslevel::VOTER)->get();
		   
	   $user = DB::table('tbl_user')
					->join('tbl_profile','tbl_profile.tbl_user_id','=','tbl_user.id')
					->join('ref_grade_level','ref_grade_level.id','=','tbl_profile.ref_grade_level_id')
					->where('is_voted', '=', 'voted')
					->groupBy('lrn')
					->orderBy('ref_grade_level_id','asc')
					->orderBy('section','asc')
					->orderBy('last_name','asc')
					->get();
		   //dd($user[0]->profile->grade->grade);
		   $data = [
			  'data' => $user      
				];
			$pdf = PDF::loadView('/reports/submitted_view', $data);  
			$pdf->setPaper('A4', 'portrait');
			return $pdf->stream('medium.pdf');
    }
	
	public function notvotedPDF()
    {
	   //$user = USER::where('ref_access_level_id',accesslevel::VOTER)->get();
	   $user = DB::table('tbl_user')
					->join('tbl_profile','tbl_profile.tbl_user_id','=','tbl_user.id')
					->join('ref_grade_level','ref_grade_level.id','=','tbl_profile.ref_grade_level_id')
					->where('is_voted', '=', '0')
					->groupBy('lrn')
					->orderBy('ref_grade_level_id','asc')
					->orderBy('section','asc')
					->orderBy('last_name','asc')
					->get();
	   //dd($user[0]->profile->grade->grade);
       $data = [
          'data' => $user      
            ];
        $pdf = PDF::loadView('/reports/not_submitted_view', $data);  
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('medium.pdf');
    }
	
	public function electedofficers()
    {
	   //$candidates = Candidate::groupBy('ref_position_id')->orderBy('ref_position_id', 'asc')->orderBy('last_name', 'asc')->get();
	   $school_data = DB::table('ref_school')
					->join('ref_region','ref_region.id','=','ref_school.ref_region_id')
					->join('ref_division','ref_division.id','=','ref_school.ref_division_id')
					->get();
	   $distinct_candidate = DB::table('tbl_candidate')
					->join('ref_position','ref_position.id','=','tbl_candidate.ref_position_id')
					->join('tbl_party','tbl_party.id','=','tbl_candidate.tbl_party_id')
					->groupBy('position_name')
					->orderBy('ref_position_id','asc')
					->orderBy('last_name','asc')
					->get();	
		
		$grade_level = DB::table('ref_grade_level')
						->orderBy('grade','desc')
						->get();
					
	   $candidates = DB::table('tbl_candidate')
					->join('ref_position','ref_position.id','=','tbl_candidate.ref_position_id')
					->join('tbl_party','tbl_party.id','=','tbl_candidate.tbl_party_id')
					->orderBy('ref_position_id','asc')
					->orderBy('ref_grade_level_id','asc')
					->orderBy('last_name','asc')
					->get();	
					
		//dd($distinct_candidate);
       $data = [
          'data' => $candidates,
		  'detail' => $distinct_candidate,
		  'school' => $school_data,
		  'grade' => $grade_level
            ];
        $pdf = PDF::loadView('/reports/list_candidates', $data);  
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('medium.pdf');
    }
	
	public function officialresult()
    {
		$ballots = Ballot::get();
        $positions = Position::get();
        
        if(session('school')->isElementary()) {
            $grades = Grade::where([['for_candidate', 1], ['for_elem', 1]])->get();
        }
        else {
            // $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
            $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
        }

        $count_ballot = array();
		$official_result = array();

        foreach($ballots as $ballot) {
            if($ballot->candidate) {
                if($ballot->position->id != 8){
                    if(!isset($count_ballot[$ballot->position->position_name])) {
                        $count_ballot[$ballot->position->position_name] = array();
                    }
                    if(!isset($count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id])) {
                        $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['vote_count'] = 0;
                        $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['candidate_id'] = $ballot->candidate->id;
                        $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['last_name'] = $ballot->candidate->last_name;
                        $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['first_name'] = $ballot->candidate->first_name;
                        $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['middle_name'] = $ballot->candidate->middle_name;
                        $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['photo'] = $ballot->candidate->photo;
                        $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['party'] = $ballot->candidate->party->party_name;
                    }
                    
                    $count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['vote_count'] += 1;
                }
                else {
					if(!isset($count_ballot[$ballot->candidate->grade->grade.' Representative'])) {
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'] = array();
					}
					if(!isset($count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id])) {
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['vote_count'] = 0;
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['candidate_id'] = $ballot->candidate->id;
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['last_name'] = $ballot->candidate->last_name;
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['first_name'] = $ballot->candidate->first_name;
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['middle_name'] = $ballot->candidate->middle_name;
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['photo'] = $ballot->candidate->photo;
                        $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['party'] = $ballot->candidate->party->party_name;
					}
					
                    $count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['vote_count'] += 1;
                }
            }
		}
		
        foreach($positions as $position) {
            if($position->id != 8) {
				$official_result[$position->position_name] = array();
            }
		}

		foreach($grades as $grade) {
			$official_result[$grade->grade.' Representative'] = array();
		}

		foreach($count_ballot as $position => $candidates) {
			$count = 0;
			$id = 0;
			foreach($candidates as $candidate => $info) {
				if($count < $info['vote_count']) {
					$count = $info['vote_count'];
					$id = $candidate;
				}
				elseif($count == $info['vote_count']) {
					$id = 0;
				}
			}
			if($id != 0) {
				$official_result[$position] = $candidates[$id];
			}
		}

		foreach($official_result as $position => $info) {
			if(!$info) {
				unset($official_result[$position]);
			}
		}

       	$data = [
		  'official_result' => $official_result,
            ];
        $pdf = PDF::loadView('/reports/list_of_elected_officers', $data);  
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('medium.pdf');
    }
	
	public function winners()
    {
		$ballots = Ballot::get();
		$positions = Position::get();

		if(session('school')->isElementary()) {
			$grades = Grade::where([['for_candidate', 1], ['for_elem', 1]])->get();
		}
		else {
			// $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
			$grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
		}

		$ballot_result = array();
		$count_ballot = array();

	   	foreach($ballots as $ballot) {
			if($ballot->candidate) {
				if($ballot->position->id != 8){
					if(!isset($count_ballot[$ballot->position->position_name])) {
						$count_ballot[$ballot->position->position_name] = array();
					}
					if(!isset($count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id])) {
						$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['vote_count'] = 0;
						$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['candidate_id'] = $ballot->candidate->id;
						$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['last_name'] = $ballot->candidate->last_name;
						$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['first_name'] = $ballot->candidate->first_name;
						$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['middle_name'] = $ballot->candidate->middle_name;
						$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['photo'] = $ballot->candidate->photo;
						$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['party'] = $ballot->candidate->party->party_name;
					}
					
					$count_ballot[$ballot->position->position_name][$ballot->tbl_candidate_id]['vote_count'] += 1;
				}
				else {
					if(!isset($count_ballot[$ballot->candidate->grade->grade.' Representative'])) {
						$count_ballot[$ballot->candidate->grade->grade.' Representative'] = array();
					}
					if(!isset($count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id])) {
						$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['vote_count'] = 0;
						$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['candidate_id'] = $ballot->candidate->id;
						$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['last_name'] = $ballot->candidate->last_name;
						$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['first_name'] = $ballot->candidate->first_name;
						$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['middle_name'] = $ballot->candidate->middle_name;
						$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['photo'] = $ballot->candidate->photo;
						$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['party'] = $ballot->candidate->party->party_name;
					}
					
					$count_ballot[$ballot->candidate->grade->grade.' Representative'][$ballot->tbl_candidate_id]['vote_count'] += 1;
				}
			}
		}

		foreach($positions as $position) {
            if($position->id != 8) {
				$ballot_result[$position->position_name] = array();
            }
		}

		foreach($grades as $grade) {
			$ballot_result[$grade->grade.' Representative'] = array();
		}

		foreach($count_ballot as $position => $info) {
			foreach($info as $id => $data) {
				$ballot_result[$position][$id] = $data;
			}
		}

		foreach($ballot_result as $position => $info) {
			if(!$info) {
				unset($ballot_result[$position]);
			}
		}
	   
       $data = [
          'data' => $ballot_result,
		];
        $pdf = PDF::loadView('/reports/winner_candidates', $data);  
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('medium.pdf');
    }
	
	
}
