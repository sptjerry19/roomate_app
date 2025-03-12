<?php

namespace App\Services\Message;

use App\Services\Base\BaseServiceInterface;

interface MessageService extends BaseServiceInterface
{
    public function getMessages(array $attribute): mixed;

    public function createMessage(string $message, ?int $receiverId): mixed;

    public function updateMessage(string $message, int $messageId): mixed;
}
