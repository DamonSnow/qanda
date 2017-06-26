<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/25
 * Time: 23:42
 */

namespace App\Mailer;

use App\User;
use Auth;

class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = ['url' => 'http://element.dev', 'name' => Auth::guard('api')->user()->name];
        $this->sendTo('zhihu_new_user_follow',$email,$data);
    }

    public function passwordReset($email, $token)
    {
        $data = ['url' => route('password.reset',$token)];
        $this->sendTo('zhihu_password_reset',$email,$data);
    }

    public function welcome(User $user)
    {
        $data = [
            'url' => route('email.verify',['token'=>$user->confirmation_token]),
            'name' => $user->name
        ];
        $this->sendTo('zhihu_app_register',$user->email,$data);
    }
}