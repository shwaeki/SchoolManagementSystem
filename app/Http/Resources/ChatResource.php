<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'sender' => $this->sender,
            'massage' => $this->message,
            'file_type' => $this->file_type,
            'file_path' => $this->file_full_path,
            'original_file_name' => $this->original_file_name,
            'created_at' => $this->created_at,
            'created_at_human' => $this->created_at_human,
        ];
    }
}
