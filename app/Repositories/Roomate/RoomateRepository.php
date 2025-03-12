<?php

namespace App\Repositories\Roomate;

use App\Repositories\Base\RepositoryInterface;

interface RoomateRepository extends RepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string;

    public function getRoomates(array $params): mixed;

    public function getRoomatesManager(array $params, ?int $page, ?int $limit): mixed;
}
