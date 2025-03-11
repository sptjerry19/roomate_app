<?php

namespace App\Repositories\Message;

use App\Repositories\Base\RepositoryInterface;

interface MessageRepository extends RepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string;

    public function getMessages(array $attribute): mixed;
}
