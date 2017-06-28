<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/28
 * Time: 22:49
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection
{
    /**
     *
     */
    public function markAsRead()
    {
        $this->each(function ($message){
            if($message->to_user_id == user()->id){
                $message->markAsRead();
            }

        });
    }
}