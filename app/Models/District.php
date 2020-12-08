<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class District extends Model
{

    use HasApiTokens, Notifiable;

    protected $table = 'districts';
    protected $primaryKey = 'district_id';
    const UPDATED_AT = NULL;
    // protected $hidden = ['entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];


    // protected $with = ['state'];

    // public function state()
    // {
    //     return $this->belongsTo('App\Models\State');
    // }

    protected $fillable = ['district_id', 'district_name', 'state_id', 'entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];

    public static function allDistrict($noOfItems,$district,$state)
    {

        $all_district = District::join('states', 'districts.state_id', '=', 'states.state_id')
            ->select('districts.district_name', 'districts.isactive', 'states.state_name')
            ->where(function ($query) use ($district) {
                if (!is_null($district)) {
                    $query->where('districts.district_name', 'LIKE', '%' . $district . '%');
                }
            })
            ->where(function ($query) use ($state) {
                if (!is_null($state)) {
                    $query->where('states.state_name', 'LIKE', '%' . $state . '%');
                }
            });

        if (!is_null($noOfItems) && is_numeric($noOfItems)) {
            $all = $all_district->paginate($noOfItems);
        } else {
            $all = $all_district->paginate(10);
        }
        // dd($all);
        return $all;
    }


    public static function getDistrictFromState($id)
    {
        $getDistrictFromState = District::where('state_id', $id)
            ->select('district_id', 'district_name')
            ->get()
            ->toArray();
        return $getDistrictFromState;
    }
}
