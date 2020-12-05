<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';
    protected $primaryKey = 'user_type';


    public function userType()
    {
        return $this->hasMany('App\Models\UserMaster','user_type',$this->primaryKey);
    }
}
