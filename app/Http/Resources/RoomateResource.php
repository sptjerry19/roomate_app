<?php

namespace App\Http\Resources;

use App\Models\Comment;
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
            "phone" => $this->phone,
            "user_id" => $this->user_id,
            "description" => $this->description,
            "images" => $this->images,
            "type" => $this->type,
            "advertisement_type" => $this->advertisement_type,
            "comment" => $this->getCommentByPostId($this->id),
            "is_favorite" => $this->checkFavorite(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }

    public function getCommentByPostId($postId)
    {
        $comments = Comment::query()->where('post_id', $postId)->get();
        return $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'user' => $comment->user,
                'post_id' => $comment->post_id,
                'content' => $comment->content,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at
            ];
        });
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

    protected function checkFavorite()
    {
        $user = auth()->user();

        // Nếu không có user hoặc không có favorites, trả về false
        if (!$user || !$this->favorites) {
            return false;
        }

        // Kiểm tra xem user_id có nằm trong danh sách favorites không
        return $this->favorites->contains(function ($favorite) use ($user) {
            return $favorite->pivot->user_id === $user->id;
        });
    }
}