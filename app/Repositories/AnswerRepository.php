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
    /**
     * @param array $attribute
     * @return mixed
     */
    public function create(array $attribute)
    {
        return Answer::create($attribute);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Answer::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAnswerCommentsById($id)
    {
        $answer = Answer::with('comments','comments.user')->where('id',$id)->first();
        return $answer->comments;
    }
}