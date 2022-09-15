<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected 
        $connection = "mysql",
        $table = "ref_school_classification";

    public $timestamps = false;
}
