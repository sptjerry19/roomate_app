<?php

namespace App\Repositories\Favorite;

use App\Models\Favorite;
use App\Repositories\Base\BaseRepository;

class FavoriteRepositoryEloquent extends BaseRepository implements FavoriteRepository
{
    public function getModel(): string
    {
        return Favorite::class;
    }
}