<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class State extends Model{

    protected $table = 'states';
    protected $primaryKey = 'state_id';
    const UPDATED_AT=NULL;

    // protected $hidden = ['entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];
    
    // protected $with = ['districts'];

    // public function districts()
    // {
    //     return $this->hasMany('App\Models\District', 'foreign_key', 'state');
    // }

    protected $fillable = ['state_id','state_name','isactive','entry_by','entry_date','updated_by','updated_date' ];

    public static function allStates(){

        $all_states = State::paginate(2);
        return $all_states;
    }
}
