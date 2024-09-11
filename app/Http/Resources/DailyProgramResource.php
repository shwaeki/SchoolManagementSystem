<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyProgramResource extends JsonResource
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
            'subject_name' => $this->subject_name,
            'image' => $this->image_path,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'day' => $this->day,
            'year_class_id ' => $this->year_class_id ,
            'created_at' => $this->created_at ,
        ];
    }
}
