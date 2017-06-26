<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/25
 * Time: 23:39
 */

namespace App\Mailer;


use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    public function sendTo($template, $email, array $data)
    {

        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use ($email) {
            $message->from('hqfdotcom@gmail.com', 'Laravel');
            $message->to($email);
        });
    }
}