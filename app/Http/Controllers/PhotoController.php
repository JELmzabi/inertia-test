<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PhotoController extends Controller
{

    function index()  {
        return Inertia::render('Photos/photoList');
    }

    function store(Request $request) {
        dd($request);
    }
    
}
