<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Optimus\Optimus;

class Village extends Model{
    protected $table = 'villages';
    protected $primaryKey = 'village_id';
    const UPDATED_AT=NULL;
    protected $fillable = ['village_id','village_name','village_code','block_id','phc_id','sub_centre_id','entry_by','entry_date','updated_by','updated_date'];

    // protected $hidden = ['entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];

    public function getVillageIdAttribute($value)
    {
    return app(Optimus::class)->encode($value);
    }
    public function getBlockIdAttribute($value)
    {
    return app(Optimus::class)->encode($value);
    }

    public static function allVillages(){
        $all_villages  = Village::join('blocks', 'villages.block_id', 'blocks.block_id')
        ->join('districts', 'blocks.district_id', 'districts.district_id')
        ->join('states', 'districts.state_id', 'states.state_id')
        ->select('villages.village_id','villages.village_name','blocks.block_name','districts.district_name','states.state_name')
        ->paginate(10);

        return $all_villages;
    }

    public static function getDetails($id){

        $village_details  = Village::join('blocks', 'villages.block_id', 'blocks.block_id')
        ->join('districts', 'blocks.district_id', 'districts.district_id')
        ->join('states', 'districts.state_id', 'states.state_id')
        ->select('villages.village_id','villages.village_name','blocks.block_name','blocks.block_id','districts.district_name','districts.district_id','states.state_name','states.state_id')
        ->where('villages.village_id',$id)
        ->first();
        return $village_details;
    }
}
