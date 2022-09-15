<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected
        $connection = 'mysql',
        $table = 'ref_grade_level';

    public function candidate() {
        return $this->hasMany(Candidate::class, 'ref_grade_level_id', 'id');
    }
}
