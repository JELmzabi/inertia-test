<?php

namespace App\Http\Controllers;

use App\Events\FollowEvent;
use App\Models\User;
use App\Notifications\FollowNotification;
use App\Notifications\UnFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    function follow(Request $request){
        $following_user = User::find($request->following_id);
        
        $following_user->followers()->attach($request->user());
        $followersCount = $following_user->followers()->count();
        $isAlreadyFollower = $following_user->followers()->where('follower_id', $request->user()->id)->exists();

        $request->user()->notify(new FollowNotification($following_user));

        return response()->json([
            'user' => $following_user,
            'isFollowing' => $isAlreadyFollower,
            'followersCount' => $followersCount
        ]);
    }

    function unfollow(Request $request){
        $following_user = User::find($request->following_id);
        
        $following_user->followers()->detach($request->user());
        $followersCount = $following_user->followers()->count();
        $isAlreadyFollower = $following_user->followers()->where('follower_id', $request->user()->id)->exists();

        $request->user()->notify(new UnFollowNotification($following_user));

        return response()->json([
            'user' => $following_user,
            'isFollowing' => $isAlreadyFollower,
            'followersCount' => $followersCount
        ]);
    }
}
