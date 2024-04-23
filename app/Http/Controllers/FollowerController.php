<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    function follow(Request $request){
        $following_id = $request->following_id;
        $request->user()->followers()->attach($following_id);

        $user = Auth::user()->followers;
        return response()->json($user);
    }
}
