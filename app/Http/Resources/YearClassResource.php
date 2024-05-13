<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class YearClassResource extends JsonResource
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
            'supervisor' => new TeacherResource($this->supervisorTeacher),
            'academicYear' => new AcadeemicYearResource($this->academicYear),
            'schoolClass' => new SchoolClassResource($this->schoolClass),
        ];
    }
}
