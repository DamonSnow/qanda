<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/25
 * Time: 14:09
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::find($id);
    }
}