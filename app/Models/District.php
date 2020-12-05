<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class District extends Model{

    use HasApiTokens, Notifiable;

    protected $table = 'districts';

    // protected $hidden = ['entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];
    

    // protected $with = ['state'];

    // public function state()
    // {
    //     return $this->belongsTo('App\Models\State');
    // }
}
