<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected
        $connection = 'mysql',
        $table = 'tbl_profile';

    public $timestamps = false;


    public function user() {
        return $this->hasOne(User::class, 'id', 'tbl_user_id');
    }
    
    public function grade() {
        return $this->hasOne(Grade::class, 'id', 'ref_grade_level_id');
    }

    public function isNotVoterRepresentative() {
        return in_array($this->grade->id, array(3, 9));
    }
}
