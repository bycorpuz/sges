<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Region;
use App\Division;
use App\Classification;
use DB;

class MainSchoolController extends Controller
{
    public function updateSchool() {
        $school = School::first();
        $region_list = Region::get();
        $classification_list = Classification::get();
        $division_list = NULL;

        if($school) {
            $division_list = Division::where('ref_region_id', $school->ref_region_id)->get();
        }

        
        return view('admin.mainschool.update', [
            'region_list' => $region_list,
            'classification_list' => $classification_list,
            'division_list' => $division_list,
            'school' => $school,
        ]);
    }

    public function updateSchoolInfo(Request $request) {
        $school_id = $request->input('school_id');
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

        if(strlen($school_id) != 6 && strlen($school_id) != 7) {
            return redirect()->back()->with('error', 'Please enter a valid school id.');
        }

        if($school_logo && !in_array($school_logo->getClientOriginalExtension(), $file_accept_types)) {
            return redirect()->back()->with('error', 'Only images are allowed to upload.');
        }

        DB::transaction(function() use($school_id, $school_name, $school_year, $classification, $region, $division, $school_logo) {
            $school = School::first();
    
            if(!$school) {
                $school = new School();
            }

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

        return redirect()->route('update_school_info')->with('success', 'School info has been updated');
    }
}
