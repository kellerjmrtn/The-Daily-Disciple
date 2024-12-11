<?php

namespace App\Services;

use App\Models\Devotion;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

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

    /**
     * Get a basic search query for devotions
     *
     * @param string|null $search
     * @return Builder
     */
    public function getSearchQuery(?string $search = null): Builder
    {
        return Devotion::when($search, function (Builder $query) use ($search) {
            $query->where(function (Builder $inner) use ($search) {
                // First apply text searches
                $inner->where('title', 'like', "%$search%")
                    ->orWhere('subtitle', 'like', "%$search%");

                // Then apply date search, if applicable
                try {
                    $date = Carbon::parse($search);

                    $inner->orWhereDate('date', $date);
                } catch (Throwable $e) {
                    // Do nothing
                }
            });
        })->orderBy('date', 'desc');
    }
}