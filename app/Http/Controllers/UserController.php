<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function getUser(Request $request, User $user) {
        $followersCount = $user->followers()->count();

        $isAlreadyFollower = $user->followers()->where('follower_id', $request->user()->id)->exists();

        return response()->json([
            'user' => $user,
            'isFollowing' => $isAlreadyFollower,
            'followersCount' => $followersCount
        ]);
    }
}
