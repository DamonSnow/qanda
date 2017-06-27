<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;

class FollowersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * FollowersController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $user = $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();
        if (in_array(user('api')->id, $followers)) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow()
    {
        $userToFollow = $this->user->byId(\request('user'));

        $followed = user('api')->followThisUser($userToFollow->id);

        if(count($followed['attached']) > 0){
            //关注用户
            $userToFollow->notify(new NewUserFollowNotification());
            $userToFollow->increment('followers_count');
            return response()->json(['followed' => true]);
        }
        //取消关注
        $userToFollow->decrement('followers_count');
        return response()->json(['followed' => false]);
    }
}
