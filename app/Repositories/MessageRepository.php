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
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    /**
     * @return mixed
     */
    public function getAllMessages()
    {
        return Message::where('to_user_id',user()->id)->orWhere('from_user_id',user()->id)
            ->with(['fromUser' => function($query) {
                return $query->select(['id','name','avatar']);
            },'toUser'=> function($query) {
                return $query->select(['id','name','avatar']);
            }])->latest()->get();
    }

    /**
     * @param $dialogId
     * @return mixed
     */
    public function getDialogMessagesBy($dialogId)
    {
        return Message::where('dialog_id',$dialogId)->with(['fromUser' => function($query) {
            return $query->select(['id','name','avatar']);
        },'toUser'=> function($query) {
            return $query->select(['id','name','avatar']);
        }])->latest()->get();
    }

    /**
     * @param $dialogId
     * @return mixed
     */
    public function getSingleMessageBy($dialogId)
    {
        return Message::where('dialog_id',$dialogId)->first();
    }
}