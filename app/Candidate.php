<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected
        $connection = 'mysql',
        $table = 'tbl_candidate';

    public $timestamps = false;

    public function party() {
        return $this->belongsTo(Party::class, 'tbl_party_id', 'id');
    }

    public function position() {
        return $this->belongsTo(Position::class, 'ref_position_id', 'id');
    }

    public function grade() {
        return $this->belongsTo(Grade::class, 'ref_grade_level_id', 'id');
    }
	
	public function getFullName() {
		$last_name = $this->last_name;
		$first_name = $this->first_name;
		$middle_name = $this->middle_name;
		
		return $last_name.", ".$first_name." ".$middle_name;
	}
}
