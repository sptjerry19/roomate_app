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
        return $this->select()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('message', 'like', "%$keyword%");
            })
            ->get();
    }
}
