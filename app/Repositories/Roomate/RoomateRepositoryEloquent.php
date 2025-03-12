<?php

namespace App\Repositories\Roomate;

use App\Models\Post;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\Log;

class RoomateRepositoryEloquent extends BaseRepository implements RoomateRepository
{
    public function getModel(): string
    {
        return Post::class;
    }

    public function getRoomates(array $params): mixed
    {
        try {
            $keyword = $params['keyword'] ?? null;
            $area = $params['area'] ?? null;
            $price = $params['price'] ?? null;
            $district = $params['district'] ?? null;
            $type = $params['type'] ?? null;
            $advertisementType = $params['advertisement_type'] ?? null;
            $limit = $params['limit'] ?? 10;

            return $this->select()->when(!is_null($area), function ($query) use ($area) {
                switch ($area) {
                    case 10:
                        return $query->where('area', '<=', 10);
                        break;

                    case 20:
                        return $query->where('area', '<=', 20)->where('area', '>=', 10);
                        break;

                    case 30:
                        return $query->where('area', '<=', 30)->where('area', '>=', 20);
                        break;

                    case 40:
                        return $query->where('area', '<=', 40)->where('area', '>=', 30);
                        break;

                    case 50:
                        return $query->where('area', '>=', 50);
                        break;

                    default:
                        return $query->where('area', '<=', $area);
                        break;
                }
            })
                ->when(!is_null($price), function ($query) use ($price) {
                    return $query->where('price', '<', $price);
                })
                ->when(!is_null($district), function ($query) use ($district) {
                    return $query->where('district', 'like', '%' . $district . '%');
                })
                ->when(!is_null($keyword), function ($query) use ($keyword) {
                    return $query->where('title', 'like', '%' . $keyword . '%');
                })
                ->when(!is_null($type), function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->when(!is_null($advertisementType), function ($query) use ($advertisementType) {
                    return $query->where('advertisement_type', $advertisementType);
                })
                ->orderByDesc('created_at')
                ->paginate($limit);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getRoomatesManager(array $params, ?int $page, ?int $limit): mixed
    {
        try {
            $userId = auth()->user()->id;
            return $this->select()->when($params['area'] ?? null, function ($query, $area) {
                switch ($area) {
                    case 10:
                        return $query->where('area', '<=', 10);
                    case 20:
                        return $query->whereBetween('area', [10, 20]);
                    case 30:
                        return $query->whereBetween('area', [20, 30]);
                    case 40:
                        return $query->whereBetween('area', [30, 40]);
                    case 50:
                        return $query->where('area', '>=', 50);
                    default:
                        return $query->where('area', '<=', $area);
                }
            })
                ->when($params['price'] ?? null, fn($query, $price) => $query->where('price', '<', $price))
                ->when($params['district'] ?? null, fn($query, $district) => $query->where('district', 'like', "%$district%"))
                ->when($params['keyword'] ?? null, fn($query, $keyword) => $query->where('title', 'like', "%$keyword%"))
                ->when($params['type'] ?? null, fn($query, $type) => $query->where('type', $type))
                ->where('user_id', $userId)
                ->orderByDesc('created_at')
                ->paginate($limit);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
