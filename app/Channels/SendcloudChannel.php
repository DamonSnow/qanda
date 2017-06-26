<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/25
 * Time: 22:49
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SendcloudChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSendcloud($notifiable);
    }
}