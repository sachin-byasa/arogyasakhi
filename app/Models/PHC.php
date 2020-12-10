<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PHC extends Model{
    protected $table = 'phc';
    protected $primaryKey = 'phc_id';
    protected $fillable = ['phc_name', 'block_id', 'entry_by', 'entry_date', 'isactive', 'updated_by', 'updated_date'];
    public $timestamps = false; 
    // protected $hidden = ['entry_by', 'entry_date', 'updated_by', 'updated_date', 'isactive'];

    public function blocks()
    {
        return $this->leftJoin('blocks','block.block_id', 'phc.block_id');
    }
}
