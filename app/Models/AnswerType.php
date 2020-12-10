<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AnswerType extends Model{
    protected $table = 'answer_type';

    use HasApiTokens;


    public function getAnswerTypeAttribute($value)
    {
        return ucfirst($value);
    }
}
