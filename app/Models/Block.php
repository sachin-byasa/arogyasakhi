<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Optimus\Optimus;

class Block extends Model{
    protected $table = 'blocks';
    protected $primaryKey = 'block_id';
    const UPDATED_AT=NULL;

    protected $hidden = ['entry_by', 'updated_by', 'updated_date', 'isactive'];

    protected $fillable =  ['block_id','block_name','district_id','isactive','entry_by','entry_date','updated_by','updated_date'];
    public function getBlockIdAttribute($value)
    {
        return app(Optimus::class)->encode($value);
    }


    public static function allBlocks(){
        $allBlocks = Block::join('districts', 'blocks.district_id', 'districts.district_id')
        ->join('states', 'districts.state_id', 'states.state_id')
        ->select('blocks.block_id','blocks.block_name','blocks.isactive','districts.district_name','states.state_name')
        ->paginate(10);

        return $allBlocks;
    }

    public static function getDetails($id){
        $blockDetail = Block::join('districts', 'blocks.district_id', 'districts.state_id')
        ->join('states', 'districts.state_id', 'states.state_id')
        ->select('blocks.block_id','blocks.block_name','blocks.isactive','districts.district_name','states.state_name','states.state_id','blocks.district_id')
        ->where('blocks.block_id',$id)
        ->first();
        // dd($blockDetail)
        return $blockDetail;
    }

    public static function getBlockFromDistrict($id){
        $getBlockFromDistrict = Block::where('district_id',$id)
        ->select('block_id','block_name')
        ->get()
        ->toArray();
        return $getBlockFromDistrict;
    }
}
