<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['name','title','path','public', 'user_id'];

    public function getPostedAgoAttribute(){
        return $this->created_at->diffForHumans();
    }

    ## Relationships 
    function user()  {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
