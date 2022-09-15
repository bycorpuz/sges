<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected 
        $connection = "mysql",
        $table = "ref_region";

    public $timestamps = false;

    public function division() {
        return $this->hasMany(Division::class, 'ref_region_id', 'id');
    }
}
