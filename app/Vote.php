<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id','answer_id'];
}
