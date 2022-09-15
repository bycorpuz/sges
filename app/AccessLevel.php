<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    CONST
        ADMIN = 1,
        COMELEC = 2,
        VOTER = 3;

    protected
        $connection = 'mysql',
        $table = 'ref_access_level';

    public function user() {
        return $this->hasMany(User::class, 'ref_access_level_id', 'id');
    }

    public function isAdmin() {
        return $this->id == AccessLevel::ADMIN;
    }

    public function isComelec() {
        return $this->id == AccessLevel::COMELEC;
    }

    public function isVoter() {
        return $this->id == AccessLevel::VOTER;
    }
}
