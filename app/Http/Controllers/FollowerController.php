<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    function follow(Request $request){
        $following_user = User::find($request->following_id);
        
        $following_user->followers()->attach($request->user());
        $followersCount = $following_user->followers()->count();
        
        return response()->json([
            'user' => $following_user,
            'followersCount' => $followersCount
        ]);
    }
}
