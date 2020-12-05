<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserMaster extends Authenticatable
{
    use HasApiTokens, Notifiable;


    protected $table = 'user_master';

    const CREATED_AT = 'entry_date';
    const UPDATED_AT = 'updated_date';
    protected $primaryKey = 'user_id'; 

    protected $fillable = [
        'user_name',
        'login_id',
        'email_id',
        'mobile_number',
        'user_key',
        'user_type',
        'arogya_sakhi_id',
        'funder_id',
        'isactive',
        'entry_by',
        'entry_date',
        'updated_by',
        'updated_date',
    ];
    // protected $with = ['userType'];

    public function userType()
    {
        return $this->belongsTo('App\Models\UserType','user_type','user_type');
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email_id;
    }

    public function getNameAttribute($value)
    {
        return $this->user_name; 
    }
    
    public function getPasswordAttribute($value)
    {
        return $this->user_key; 
    }

    public function getEmailAttribute($value)
    {
        return $this->email_id; 
    }

    // public function getEmailVerifiedAtAttributes($value)
    // {
    //     return $this->qEmailVerifiedAt; 
    // }

}
