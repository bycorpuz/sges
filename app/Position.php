<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected
        $connection = 'mysql',
        $table = 'ref_position';

    public $timestamps = false;

    public function candidate() {
        return $this->hasMany(Candidate::class, 'ref_position_id', 'id');
    }
}
