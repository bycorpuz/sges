<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected 
        $connection = "mysql",
        $table = "tbl_user";

    public $timestamps = false;

    public function accessLevel() {
        return $this->hasOne(AccessLevel::class, 'id', 'ref_access_level_id');
    }

    public function profile() {
        return $this->hasOne(Profile::class, 'tbl_user_id', 'id');
    }

    public function ballot() {
        return $this->hasMany(Ballot::class, 'tbl_user_id', 'id');
    }
	public function hasVoted() {
		return $this->ballot->count() > 1;	
	}
	
    public function generateVoterPassword() {
        $password = $this->password;
        $password_salt = $this->password_salt;
        $positions = "";
        $voter_password = "";
        $used = array();

        foreach(str_split($password_salt) as $salt) {
            $ascii = ord($salt);
            if(strlen($ascii) == 1) {
                $sum = $ascii;
            }
            else {
                while(strlen($ascii) > 1) {
                    $sum = 0;
                    foreach(str_split($ascii) as $ascii_char) {
                        $sum += $ascii_char;
                    }
                    $ascii = $sum;
                }
            }

            while(in_array($sum, $used)) {
                $sum += 1;
                if($sum > 9) {
                    $sum = 0;
                }
            }
            array_push($used, $sum);
            $positions .= $sum;
        }

        foreach(str_split($positions) as $position) {
            $voter_password .= substr($password, $position, 1);
        }

        return $voter_password;
    }

    public function generateVoterPasswordByPasswordAndSalt($password, $password_salt) {
        $password = $password;
        $password_salt = $password_salt;
        $positions = "";
        $voter_password = "";
        $used = array();

        foreach(str_split($password_salt) as $salt) {
            $ascii = ord($salt);
            if(strlen($ascii) == 1) {
                $sum = $ascii;
            }
            else {
                while(strlen($ascii) > 1) {
                    $sum = 0;
                    foreach(str_split($ascii) as $ascii_char) {
                        $sum += $ascii_char;
                    }
                    $ascii = $sum;
                }
            }

            while(in_array($sum, $used)) {
                $sum += 1;
                if($sum > 9) {
                    $sum = 0;
                }
            }
            array_push($used, $sum);
            $positions .= $sum;
        }

        foreach(str_split($positions) as $position) {
            $voter_password .= substr($password, $position, 1);
        }

        return $voter_password;
    }
}
