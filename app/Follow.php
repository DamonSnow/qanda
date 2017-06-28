<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_question';
    /**
     * @var array
     */
    protected $fillable = ['user_id','question_id'];
}
