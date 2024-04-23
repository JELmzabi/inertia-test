<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    function getUser(User $user) {
        $followersCount = $user->followers()->count();
        return response()->json([
            'user' => $user,
            'followersCount' => $followersCount
        ]);
    }
}
