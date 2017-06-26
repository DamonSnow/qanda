<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/25
 * Time: 1:22
 */

namespace App\Repositories;


use App\Answer;

class AnswerRepository
{
    public function create(array $attribute)
    {
        return Answer::create($attribute);
    }
}