<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Candidate;
use DB;

class PositionController extends Controller
{
    public function positionList(Request $request) {
        
        $id = $request->id;

        if($id) {
            $position = Position::find($id);
            if($position) {
                return view('comelec.position.edit', [
                    'position' => $position,
                ]);
            }
            return redirect()->route('position_list');
        }
        
        $positions = Position::Paginate(15);
        return view('comelec.position.index', [
            'positions' => $positions,
        ]);
    }
    
    public function updatePosition(Request $request) {
        $position_name = trim($request->position_name);
        $position_description = trim($request->position_description);
        $position_select_limit = trim($request->position_select_limit);

        $validate = $position_name == ""; 
        
        if($validate) {
            return redirect()->back()->with('error', 'Please fill up the required fields.');
        }

        $id = $request->id;
        
        $position = Position::find($id);

        $position->position_name = $position_name;
        $position->position_description = $position_description;
        $position->position_select_limit = $position_select_limit;

        $position->save();

        return redirect()->route('position_list')->with('success', 'Position has been updated.');
    }

    public function addPosition() {
        return view('comelec.position.add');
    }

    public function createPosition(Request $request) {
        $position_name = trim($request->position_name);
        $position_description = trim($request->position_description);
        $position_select_limit = trim($request->position_select_limit);

        $validate = trim($position_name) == ""; 
        
        if($validate) {
            return redirect()->back()->with('error', 'Please fill up the required fields.');
        }

        $position = Position::where('position_name', 'like', '%'.$position_name.'%')->count();
        
        if($position) {
            return redirect()->back()->with('error', 'Position has already been taken.');
        }

        $position = new Position();

        $position->position_name = $position_name;
        $position->position_description = $position_description;
        $position->position_select_limit = $position_select_limit;

        $position->save();

        return redirect()->route('position_list')->with('success', 'Position has been created.');
    }

    public function deletePosition(Request $request) {
        $id = $request->id;

        $position = Position::find($id);

        if($position) {
            DB::transaction(function() use($id) {
                Position::find($id)->delete();
                Candidate::where('ref_position_id', $id)->delete();
            });
        }
        return redirect()->route('position_list')->with('success', 'Position has been deleted.');
    }
}
