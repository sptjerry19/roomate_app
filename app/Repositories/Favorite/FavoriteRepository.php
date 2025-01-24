<?php

namespace App\Repositories\Favorite;

use App\Repositories\Base\RepositoryInterface;

interface FavoriteRepository extends RepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string;
}