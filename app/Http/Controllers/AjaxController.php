<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\Division;

class AjaxController extends Controller
{
    public function searchDivisionByRegion(Request $request) {
        $region_id = $request->id;
        $division_list = Division::where('ref_region_id', $region_id)->get();
        $options = "<option value=''>--- Select ---</option>";
        
        foreach($division_list as $division) {
            $options .= '<option value="'.$division->id.'">'.$division->division_name.'</option>';
        }

        return response()->json($options);
    }
}
