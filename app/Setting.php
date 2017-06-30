<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/7/1
 * Time: 2:31
 */

namespace App;


class Setting
{
    protected $allowed = ['city','bio'];
    protected $user;

    /**
     * Setting constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function merge(array $attributes)
    {
        $settings = array_merge($this->user->settings,array_only($attributes, $this->allowed));
        return $this->user->update(['settings' => $settings]);
    }
}