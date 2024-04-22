<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    function getUser(User $user) {
        return response()->json($user);
    }
}
