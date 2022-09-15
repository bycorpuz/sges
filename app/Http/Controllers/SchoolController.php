<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Region;
use App\Division;
use App\Classification;
use DB;

class SchoolController extends Controller
{
    public function schoolList(Request $request) {
        $id = $request->id;

        if($id) {
            $school = School::find($id);
            if($school) {
                $region_list = Region::orderBy('rank', 'ASC')->get();
                $classification_list = Classification::get();
                $division_list = Division::where('ref_region_id', $school->ref_region_id)->get();

                return view('admin.school.edit', [
                    'region_list' => $region_list,
                    'classification_list' => $classification_list,
                    'division_list' => $division_list,
                    'school' => $school,
                ]);
            }
            return redirect()->route('school_list');
        }

        $schools = School::paginate(15);

        return view('admin.school.index', [
            'schools' => $schools,
        ]);
    }

    public function addSchool(Request $request) {
        $region_list = Region::orderBy('rank', 'ASC')->get();
        $classification_list = Classification::get();
        return view('admin.school.add', [
            'region_list' => $region_list,
            'classification_list' => $classification_list,
        ]);
    }

    public function createSchool(Request $request) {
        $school_id = trim($request->input('school_id'));
        $school_name = trim($request->input('school_name'));
        $school_year = $request->input('school_year');
        $classification = $request->input('classification');
        $region = $request->input('region');
        $division = $request->input('division');
        $school_logo = $request->file('school_logo');

        $file_accept_types = array(
            'jpg',
            'png',
        );

        $validation = $school_id == NULL || $school_name == NULL;

        if($validation) {
            return redirect()->back()->with('error', 'Please fill up all the required fields.');
        }

        if($school_logo && !in_array($school_logo->getClientOriginalExtension(), $file_accept_types)) {
            return redirect()->back()->with('error', 'Only images are allowed to upload.');
        }

        $school = School::where('school_id', $school_id)->first();

        if($school) {
            return redirect()->back()->with('error', 'School ID has already been registered.');
        }

        DB::transaction(function() use($school_id, $school_name, $school_year, $classification, $region, $division, $school_logo) {
            $school = new School();
    
            $school->school_id = $school_id;
            $school->school_name = $school_name;
            $school->school_year = $school_year;
            $school->ref_classification_id = $classification;
            $school->ref_region_id = $region;
            $school->ref_division_id = $division;
    
            $school->save();

            if($school_logo) {
                $image_destination = "school";

                $image_name = $school->id.'.'.$school_logo->getClientOriginalExtension();
                $school_logo->move($image_destination, $image_name);
                $school->school_logo = '/school/'.$image_name;
                $school->save();
            }
        });

        return redirect()->route('school_list')->with('success', 'School has been added');
    }

    public function updateSchool(Request $request) {
        $school_id = trim($request->input('school_id'));
        $school_name = trim($request->input('school_name'));
        $school_year = $request->input('school_year');
        $classification = $request->input('classification');
        $region = $request->input('region');
        $division = $request->input('division');
        $school_logo = $request->file('school_logo');
        $id = $request->id;

        $file_accept_types = array(
            'jpg',
            'png',
        );

        $validation = $school_id == NULL || $school_name == NULL;

        if($validation) {
            return redirect()->back()->with('error', 'Please fill up all the required fields.');
        }

        if($school_logo && !in_array($school_logo->getClientOriginalExtension(), $file_accept_types)) {
            return redirect()->back()->with('error', 'Only images are allowed to upload.');
        }

        $school = School::find($id);

        if($school->school_id != $school_id) {
            $school_check = School::where('school_id', $school_id)->first();
            if($school_check) {
                return redirect()->back()->with('error', 'School ID has already been registered.');
            }
        }

        DB::transaction(function() use($school_id, $school_name, $school_year, $classification, $region, $division, $school_logo, $school) {

            $school->school_id = $school_id;
            $school->school_name = $school_name;
            $school->school_year = $school_year;
            $school->ref_classification_id = $classification;
            $school->ref_region_id = $region;
            $school->ref_division_id = $division;
    
            
            if($school_logo) {
                $image_destination = "school";
                
                $image_name = $school->id.'.'.$school_logo->getClientOriginalExtension();
                $school_logo->move($image_destination, $image_name);
                $school->school_logo = '/school/'.$image_name;
            }

            $school->save();
        });

        return redirect()->route('school_list')->with('success', 'School has been updated');
    }

    public function deleteSchool(Request $request) {
        $id = $request->id;
        
    }
}
