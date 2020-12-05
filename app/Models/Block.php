<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Block extends Model{
    protected $table = 'blocks';

    protected $hidden = ['entry_by', 'updated_by', 'updated_date', 'isactive'];

}
