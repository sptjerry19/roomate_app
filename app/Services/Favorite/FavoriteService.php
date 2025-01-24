<?php

namespace App\Services\Favorite;

use App\Services\Base\BaseServiceInterface;

interface FavoriteService extends BaseServiceInterface
{
    // public function getFavorites($userId): mixed;

    public function addFavorite($roomId): mixed;

    public function removeFavorite($roomId): mixed;
}