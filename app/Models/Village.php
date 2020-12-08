<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Optimus\Optimus;

class Village extends Model
{
    protected $table = 'villages';
    protected $primaryKey = 'village_id';
    const UPDATED_AT = NULL;
    protected $fillable = ['village_id', 'village_name', 'village_code', 'block_id', 'phc_id', 'sub_centre_id', 'entry_by', 'entry_date', 'updated_by', 'updated_date'];

    // protected $hidden = ['entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];

    public function getVillageIdAttribute($value)
    {
        return app(Optimus::class)->encode($value);
    }
    public function getBlockIdAttribute($value)
    {
        return app(Optimus::class)->encode($value);
    }

    public static function allVillages($noOfItems, $villageName, $block, $district, $state)
    {
        $all_villages  = Village::join('blocks', 'villages.block_id', 'blocks.block_id')
            ->join('districts', 'blocks.district_id', 'districts.district_id')
            ->join('states', 'districts.state_id', 'states.state_id')
            ->select('villages.village_id', 'villages.village_name', 'blocks.block_name', 'districts.district_name', 'states.state_name')
            ->where(function ($query) use ($villageName) {
                if (!is_null($villageName)) {
                    $query->where('villages.village_name', 'LIKE', '%' . $villageName . '%');
                }
            })
            ->where(function ($query) use ($block) {
                if (!is_null($block)) {
                    $query->where('blocks.block_name', 'LIKE', '%' . $block . '%');
                }
            })
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
            $all = $all_villages->paginate($noOfItems);
        } else {
            $all =   $all_villages->paginate(10);
        }



        return $all;
    }

    public static function getDetails($id)
    {

        $village_details  = Village::join('blocks', 'villages.block_id', 'blocks.block_id')
            ->join('districts', 'blocks.district_id', 'districts.district_id')
            ->join('states', 'districts.state_id', 'states.state_id')
            ->select('villages.village_id', 'villages.village_name', 'blocks.block_name', 'blocks.block_id', 'districts.district_name', 'districts.district_id', 'states.state_name', 'states.state_id')
            ->where('villages.village_id', $id)
            ->first();
        return $village_details;
    }
}
