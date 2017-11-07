<?php
/**
 * Created by PhpStorm.
 * User: hqfdo
 * Date: 2017/6/27
 * Time: 22:50
 */

namespace App\Repositories;

use App\Topic;
use Illuminate\Http\Request;


class TopicRepository
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getTopicsForTagging(Request $request)
    {
        $topic = Topic::select(['id', 'name'])
            ->where('name', 'like', '%' . $request->query('q') . '%')
            ->get();
        return $topic;
    }
}