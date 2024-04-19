<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'path' => Storage::disk('photos')->url($this->path),
            'title' => $this->title,
            'public' => $this->public,
            'user' => new UserResource($this->user),
            'posted_ago' => $this->created_at->diffForHumans(),
        ];
    }
}
