<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected
        $connection = 'mysql',
        $table = 'tbl_party';

    public $timestamps = false;

    public function candidate() {
        return $this->hasMany(Candidate::class, 'tbl_party_id', 'id');
    }
}
