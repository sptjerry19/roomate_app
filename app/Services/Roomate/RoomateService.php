<?php

namespace App\Services\Roomate;

use App\Services\Base\BaseServiceInterface;

interface RoomateService extends BaseServiceInterface
{
    public function getRoomates(array $params): mixed;

    public function getRoomatesManager(array $params, ?int $page, ?int $limit): mixed;

    public function createRoomate(array $attributes): mixed;

    public function updateRoomate(array $attributes, int $id): mixed;
}
