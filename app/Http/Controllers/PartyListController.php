<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use App\Candidate;
use DB;

class PartyListController extends Controller
{
    public function partyList(Request $request) {
        $id = $request->id;
        $s = $request->s ? : '';

        if($id) {
            $party = Party::find($id);
            if($party) {
                return view('comelec.party.edit', [
                    'party' => $party,
                ]);
            }
            return redirect()->route('party_list');
        }
        
        if($s) {
            $party_list = Party::where([['id', '<>', 1], ['party_name', 'like', '%'.$s.'%']])->paginate(15);
        }
        else {
            $party_list = Party::where('id', '<>', 1)->paginate(15);
        }

        return view('comelec.party.index', [
            'party_list' => $party_list,
        ]);
    }

    public function addParty() {
        return view('comelec.party.add');
    }

    public function createParty(Request $request) {
        $party_name = trim($request->input('party_name'));
        $description = trim($request->input('description'));

        if($party_name == NULL) {
            return redirect()->back()->with('error', 'Please complete the required fields.');
        }

        $party = Party::where('party_name', 'like', '%'.$party_name.'%')->count();
        
        if($party) {
            return redirect()->back()->with('error', 'Party list has already been taken.');
        }

        $party = new Party();

        $party->party_name = $party_name;
        $party->description = $description;

        $party->save();

        return redirect()->route('party_list')->with('success', 'New party list has been created.');
    }

    public function updateParty(Request $request) {
        $party_name = trim($request->input('party_name'));
        $description = trim($request->input('description'));
        $id = $request->id;

        if(trim($party_name) == NULL) {
            return redirect()->back()->with('error', 'Please complete the required fields.');
        }
        
        $party = Party::find($id);

        $party->party_name = $party_name;
        $party->description = $description;

        $party->save();

        return redirect()->route('party_list')->with('success', 'New party list has been updated.');
    }

    public function deleteParty(Request $request) {
        $id = $request->id;

        $party = Party::find($id);

        if($party) {
            DB::transaction(function() use($id) {
                Party::find($id)->delete();
                Candidate::where('tbl_party_id', $id)->delete();
            });
        }

        return redirect()->route('party_list')->with('success', 'Party list has been deleted.');
    }

    public function getPartyListInfo(Request $request) {
        $party_id = $request->party_id;

        $party = Party::find($party_id);

        return response()->json($party);
    }
}
