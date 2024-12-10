<?php

namespace App\Services;

use App\Models\Devotion;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DevotionService
{
    /**
     * Get today's devotion
     *
     * @return Devotion|null
     */
    public function getToday(): ?Devotion
    {
        return Devotion::visible()
            ->whereDate('date', Carbon::now())
            ->first();
    }

    /**
     * Get $count related devotions
     *
     * @param Devotion $devotion
     * @param int $count
     * @return Collection
     */
    public function getRelatedDevotionsFor(Devotion $devotion, int $count = 5): Collection
    {
        return Devotion::visible()
            ->where('id', '!=', $devotion->id)
            ->orderBy('date', 'desc')
            ->limit($count)
            ->get();
    }

    /**
     * Get a paginated index of all devotionals
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedIndex(int $perPage = 24): LengthAwarePaginator
    {
        return Devotion::visible()
            ->orderBy('date', 'desc')
            ->paginate($perPage);
    }
}