<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PhotoController extends Controller
{

    function index()  {

        $photos = Photo::with('user')->where('public', true)->get();
        $p = PhotoResource::collection($photos);
        // dd($p);
        return Inertia::render('Photos/PhotoList', ['photos' => $p]);
    }

    function store(UploadPhotoRequest $request) {
        $file = $request->file('photo');
        $path = $request->file('photo')->store(options:'photos');
        
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $createdPhoto = Auth::user()->photos()->create([
            'name' => $fileName,
            'title' => $request->title,
            'path' => $path,
            'public' => $request->public
        ]);

        $usersShouldBeNotified = $request->user()->followers;
        Notification::send($usersShouldBeNotified, new NewPostNotification($request->user(), $createdPhoto));

        return to_route('photos.index');
        
    }

    public function myPhotos(){
        $photos = PhotoResource::collection(Photo::where('user_id', Auth::id())->get());
        
        return Inertia::render('Photos/MyPhotos', compact('photos'));
    }

    public function show(Photo $photo){
        $photo = new PhotoResource($photo);
        return Inertia::render('Photos/PhotoShow', compact('photo'));
    }
    
}
