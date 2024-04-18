<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PhotoController extends Controller
{

    function index()  {
        return Inertia::render('Photos/PhotoList');
    }

    function store(Request $request) {
        dd($request);
    }
    
}
