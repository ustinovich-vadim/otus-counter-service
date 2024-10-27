<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class CounterController extends Controller
{
    public function increment(Request $request): Response
    {
        $userId = $request->route('userId');
        Redis::incr("user:{$userId}:unread_count");

        return response()->json(['status' => 'success']);
    }

    public function decrement(Request $request): Response
    {
        $userId = $request->route('userId');
        Redis::decr("user:{$userId}:unread_count");

        return response()->json(['status' => 'success']);
    }

    public function getCounter($userId): Response
    {
        $count = Redis::get("user:{$userId}:unread_count") ?? 0;

        return response()->json(['user_id' => $userId, 'unread_count' => (int) $count]);
    }

    public function sync(Request $request, $userId): Response
    {
        Redis::set("user:{$userId}:unread_count", $request->integer('count-of-unread-messages'));

        return response()->json(['status' => 'success']);
    }
}
