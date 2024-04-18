<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PhotoController extends Controller
{

    function index()  {
        return Inertia::render('Photos/PhotoList');
    }

    function store(Request $request) {
        $request->file('photo')->store('/', 'photos');
        dd($request);
    }
    
}
