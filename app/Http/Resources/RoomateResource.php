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
            "price" => $this->formatPrice($this->price),
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

    public function formatPrice($price)
    {
        // Remove any non-numeric characters except dot and comma
        $numericPrice = preg_replace('/[^\d.,]/', '', $price);

        // Handle cases where commas and dots are mixed (e.g., European format)
        if (strpos($numericPrice, ',') !== false && strpos($numericPrice, '.') === false) {
            // Convert comma to dot for decimal point
            $numericPrice = str_replace(',', '.', $numericPrice);
        } elseif (strpos($numericPrice, ',') !== false && strpos($numericPrice, '.') !== false) {
            // Remove thousand separators if format is '1.234,56'
            $numericPrice = str_replace('.', '', $numericPrice);
            $numericPrice = str_replace(',', '.', $numericPrice);
        }

        // Convert to float
        $floatPrice = (float) $numericPrice;

        // Format price
        return number_format($floatPrice, 0, ',', '.');
    }
}
