<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content' => $this->content,
            'images' => $this->photos->map(function ($photo) {
                return $photo->image_path;
            }),
            'likes_count' => $this->likes->count(),
            'is_liked' => auth()->user()->likes()->where('post_id', $this->id)->exists(),
            'created_at' => $this->created_at ,
        ];
    }
}
