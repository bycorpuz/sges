<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Candidate;
use App\Party;
use App\Position;
use App\Grade;
use DB;

class CandidateController extends Controller
{
    public function candidateList(Request $request) {
        $id = $request->id;
        $search = $request->search ? : '';
        $grade = $request->search_grade ? : '';
        $position = $request->search_position ? : '';
        $party = $request->search_party ? : '';

        if(session('school')->isElementary()) {
            $grades = Grade::where([['for_candidate', 1], ['for_elem', 1]])->get();
        }
        else {
            // $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
            $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
        }
        $positions = Position::get();
        $party_list = Party::get();

        if($id) {
            $candidate = Candidate::find($id);
            if($candidate) {
                $party_list = Party::get();
                $positions = Position::get();

                if(session('school')->isElementary()) {
                    $grades = Grade::where([['for_candidate', 1], ['for_elem', 1]])->get();
                }
                else {
                    $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
                }

                return view('comelec.candidate.edit', [
                    'candidate' => $candidate,
                    'party_list' => $party_list,
                    'positions' => $positions,
                    'grades' => $grades,
                ]);
            }
            return redirect()->route('candidate_list');
        }

        if($search || $grade || $party || $position) {

            $candidates = DB::table('tbl_candidate')
                            ->leftjoin('ref_grade_level', 'tbl_candidate.ref_grade_level_id', '=', 'ref_grade_level.id')
                            ->join('ref_position', 'tbl_candidate.ref_position_id', '=', 'ref_position.id')
                            ->join('tbl_party', 'tbl_candidate.tbl_party_id', '=', 'tbl_party.id')
                            ->select('tbl_candidate.*', 'tbl_party.party_name', 'ref_grade_level.grade', 'ref_position.position_name')
                            ->orderBy('tbl_candidate.ref_position_id', 'ASC')
                            ->orderBy('tbl_candidate.last_name', 'ASC');

            if($grade) {
                $candidates = $candidates->where('ref_grade_level_id', $grade);
            }

            if($search) {
                $candidates = $candidates->where(function($query) use($search) {
                                    $query->where('first_name', 'LIKE', '%'.$search.'%')
                                        ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                                        ->orWhere('middle_name', 'LIKE', '%'.$search.'%');
                                });
            }

            if($party) {
                $candidates = $candidates->where('tbl_party_id', $party);
            }

            if($position) {
                $candidates = $candidates->where('ref_position_id', $position);
            }

            $candidates = $candidates->paginate(15);
        }
        else {
            $candidates = DB::table('tbl_candidate')
            ->leftjoin('ref_grade_level', 'tbl_candidate.ref_grade_level_id', '=', 'ref_grade_level.id')
            ->join('ref_position', 'tbl_candidate.ref_position_id', '=', 'ref_position.id')
            ->join('tbl_party', 'tbl_candidate.tbl_party_id', '=', 'tbl_party.id')
            ->select('tbl_candidate.*', 'tbl_party.party_name', 'ref_grade_level.grade', 'ref_position.position_name')
            ->orderBy('tbl_candidate.ref_position_id', 'ASC')
            ->orderBy('tbl_candidate.last_name', 'ASC')
            ->paginate(15);
        }

        return view('comelec.candidate.index', [
            'candidates' => $candidates,
            'grades' => $grades,
            'positions' => $positions,
            'party_list' => $party_list,
            'search' => $search,
            'grade' => $grade,
            'position' => $position,
            'party' => $party,
        ]);
    }

    public function updateCandidate(Request $request) {
        $last_name = trim($request->input('last_name'));
        $first_name = trim($request->input('first_name'));
        $middle_name = trim($request->input('middle_name'));
        $party = $request->input('party');
        $position = $request->input('position');
        $grade = $request->input('grade');
        $photo = $request->file('photo');

        $id = $request->id;

        $file_accept_types = array(
            'jpg',
            'png',
        );

        if($last_name == NULL || $first_name == NULL) {
            return redirect()->back()->with('error', 'Please complete all the required fields.');
        }

        if($photo && !in_array($photo->getClientOriginalExtension(), $file_accept_types)) {
            return redirect()->back()->with('error', 'Only images are allowed to upload.');
        }

        DB::transaction(function() use ($id, $photo, $last_name, $first_name, $middle_name, $party, $position, $grade) {
            $candidate = Candidate::find($id);

            if($candidate) {
                $candidate->last_name = $last_name;
                $candidate->first_name = $first_name;
                $candidate->middle_name = $middle_name;
                $candidate->tbl_party_id = $party;
                $candidate->ref_position_id = $position;
                $candidate->ref_grade_level_id = $grade;

                $candidate->save();

                if($photo) {
                    $image_destination = "candidate";

                    $image_name = $candidate->id.'.'.$photo->getClientOriginalExtension();
                    $photo->move($image_destination, $image_name);
                    $candidate->photo = '/candidate/'.$image_name;
                    $candidate->save();
                }
            }
        });

        return redirect()->route('candidate_list')->with('success', 'Candidate has been updated.');
    }

    public function addCandidate() {
        $party_list = Party::get();
        $positions = Position::get();

        if(session('school')->isElementary()) {
            $grades = Grade::where([['for_candidate', 1], ['for_elem', 1]])->get();
        }
        else {
            $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
        }

        return view('comelec.candidate.add',[
            'party_list' => $party_list,
            'positions' => $positions,
            'grades' => $grades,
        ]);
    }

    public function createCandidate(Request $request) {
        $last_name = trim($request->input('last_name'));
        $first_name = trim($request->input('first_name'));
        $middle_name = trim($request->input('middle_name'));
        $party = $request->input('party');
        $position = $request->input('position');
        $grade = $request->input('grade');
        $photo = $request->file('photo');

        $file_accept_types = array(
            'jpg',
            'png',
        );

        if($last_name == NULL || $first_name == NULL) {
            return redirect()->back()->with('error', 'Please complete all the required fields.');
        }

        if($photo && !in_array($photo->getClientOriginalExtension(), $file_accept_types)) {
            return redirect()->back()->with('error', 'Only images are allowed to upload.');
        }

        $candidate = Candidate::where([
                        ['last_name', $last_name],
                        ['first_name', $first_name],
                        ['middle_name', $middle_name],
                        ['ref_position_id', $position]
                    ])->first();

        if($candidate) {
            return redirect()->back()->with('error', 'Student is not allowed to enter in the same position more than once.');
        };

        DB::transaction(function() use ($photo, $last_name, $first_name, $middle_name, $party, $position, $grade) {

            $candidate = new Candidate;

            $candidate->last_name = $last_name;
            $candidate->first_name = $first_name;
            $candidate->middle_name = $middle_name;
            $candidate->tbl_party_id = $party;
            $candidate->ref_position_id = $position;
            $candidate->ref_grade_level_id = $grade;

            $candidate->save();

            if($photo) {
                $image_destination = "candidate";

                $image_name = $candidate->id.'.'.$photo->getClientOriginalExtension();
                $photo->move($image_destination, $image_name);
                $candidate->photo = '/candidate/'.$image_name;
                $candidate->save();
            }
        });

        return redirect()->route('candidate_list')->with('success', 'New candidate has been added.');
    }

    public function deleteCandidate(Request $request) {
        $id = $request->id;
        $candidate = Candidate::find($id);

        if($candidate) {
            $candidate->delete();
            return redirect()->route('candidate_list')->with('success', 'Candidate has been removed');
        }
        return redirect()->route('candidate_list');
    }

    public function getCandidateInfo(Request $request) {
        $candidate_id = $request->candidate_id;
        $candidate = Candidate::find($candidate_id);

        $party_list = Party::get();
        $positions = Position::get();

        if(session('school')->isElementary()) {
            $grades = Grade::where([['for_candidate', 1], ['for_elem', 1]])->get();
        }
        else {
            $grades = Grade::where('for_candidate', 1)->whereNull('for_elem')->get();
        }

        $data = array();

        $data['candidate'] = $candidate;

        $data['party_list'] = "<option value=''> --- Party List ---</option>";
        $data['position'] = "<option value=''> --- Position ---</option>";
        $data['grade'] = "<option value=''> --- Grade ---</option>";

        // $data['view_grade'] = $candidate->ref_position_id == 8;
        if ($candidate->ref_position_id) {
            $data['view_grade'] = 'withGradeLevel';
        };

        foreach($positions as $position){
            $data['position'] .= '<option value="'.$position->id.'"'.($position->id == $candidate->ref_position_id ? ' selected' : '').'>'.$position->position_name.'</option>';
        }

        foreach($grades as $grade){
            $data['grade'] .= '<option value="'.$grade->id.'"'.($grade->id == $candidate->ref_grade_level_id ? ' selected' : '').'>'.$grade->grade.'</option>';
        }

        foreach($party_list as $party){
            $data['party_list'] .= '<option value="'.$party->id.'"'.($party->id == $candidate->tbl_party_id ? ' selected' : '').'>'.$party->party_name.'</option>';
        }

        if($candidate->photo) {
            $data['photo'] = '<a href="'.$candidate->photo.'" target="_blank"><img src="'.$candidate->photo.'" width="75px"></a>';
        }
        else {
            $data['photo'] = "No Photo Uploaded";
        }

        return response()->json($data);

    }
}
