<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected 
        $connection = "mysql",
        $table = "ref_division";

    public $timestamps = false;

    public function region() {
        return $this->belongsTo(Region::class, 'ref_region_id', 'id');
    }
}
