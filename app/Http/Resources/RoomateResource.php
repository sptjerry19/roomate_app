<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "location" => $this->location,
            "district" => $this->district,
            "ward" => $this->ward,
            "price" => $this->price,
            "area" => $this->area,
            "status" => $this->status,
            "posted_by" => $this->posted_by,
            "user_id" => $this->user_id,
            "description" => $this->description,
            "images" => $this->images,
            "type" => $this->type,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
