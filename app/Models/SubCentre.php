<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SubCentre extends Model{
    protected $table = 'sub_centres';
    const CREATED_AT = 'entry_date';
    const UPDATED_AT = 'updated_date';
    protected $primaryKey = 'sub_centre_id';
    protected $fillable  = ['sub_centre_name', 'phc_id', 'isactive', 'entry_by', 'entry_date', 'updated_by', 'updated_date'];
}
