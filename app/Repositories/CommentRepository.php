<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/27
 * Time: 22:37
 */

namespace App\Repositories;


use App\Comment;

class CommentRepository
{
    public function create(array $attribute)
    {
        return Comment::create($attribute);
    }
}