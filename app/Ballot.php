<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    protected
        $connection = 'mysql',
        $table = 'tbl_ballot';

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class, 'tbl_user_id', 'id');
    }

    public function candidate() {
        return $this->belongsTo(Candidate::class, 'tbl_candidate_id', 'id');
    }

    public function position() {
        return $this->belongsTo(Position::class, 'ref_position_id', 'id');
    }
}
