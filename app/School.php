<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected 
        $connection = "mysql",
        $table = "ref_school";

    public $timestamps = false;

    public function region() {
        return $this->belongsTo(Region::class, 'ref_region_id', 'id');
    }

    public function division() {
        return $this->belongsTo(Division::class, 'ref_division_id', 'id');
    }

    public function classification() {
        return $this->belongsTo(Classification::class, 'ref_classification_id', 'id');
    }

    public function isElementary() {
        return $this->classification->id == 1;
    }
}
