<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/27
 * Time: 20:47
 */

namespace App\Repositories;


use App\Message;

class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }
}