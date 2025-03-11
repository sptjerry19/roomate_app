<?php

namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\Base\BaseRepository;

class MessageRepositoryEloquent extends BaseRepository implements MessageRepository
{
    public function getModel(): string
    {
        return Message::class;
    }

    public function getMessages(array $attribute): mixed
    {
        $keyword = $attribute['keyword'] ?? null;
        $userId = auth()->user()->id;
        $receiverId = $attribute['receiver_id'] ?? null;
        return $this->select()->with('user')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('message', 'like', "%$keyword%");
            })
            ->when($receiverId, function ($query) use ($receiverId, $userId) {
                $query->where('receiver_id', $receiverId)
                    ->where('user_id', $userId)
                    ->orWhere('receiver_id', $userId)
                    ->where('user_id', $receiverId);
            })
            ->get();
    }
}
