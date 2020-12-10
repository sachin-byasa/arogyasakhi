<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'states';
    protected $primaryKey = 'state_id';
    const UPDATED_AT = NULL;

    // protected $hidden = ['entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];

    // protected $with = ['districts'];

    // public function districts()
    // {
    //     return $this->hasMany('App\Models\District', 'foreign_key', 'state');
    // }

    protected $fillable = ['state_id', 'state_name', 'isactive', 'entry_by', 'entry_date', 'updated_by', 'updated_date'];

    public static function allStates($noOfItems, $state)
    {

        $all_states = State::where(function ($query) use ($state) {
            if (!is_null($state)) {
                $query->where('states.state_name', 'LIKE', '%' . $state . '%');
            }
        });

        if (!is_null($noOfItems) && is_numeric($noOfItems)) {
            $all = $all_states->paginate($noOfItems);
        } else {
            $all = $all_states->paginate(10);
        }
        // dd($all);
        return $all;
    }
}
