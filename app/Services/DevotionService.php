<?php

namespace App\Services;

use App\Models\Devotion;
use App\Models\Verse;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

    /**
     * Create or update the given devotion with the given data
     *
     * @param Devotion $devotion
     * @param array $data
     * @return Devotion
     */
    public function save(Devotion $devotion, array $data): Devotion
    {
        $devotion->title = $data['title'];
        $devotion->subtitle = $data['subtitle'];
        $devotion->content = $data['content'];
        $devotion->date = $data['date'];
        $devotion->status = $data['status'];
        $devotion->slug = Str::slug($devotion->title);

        $devotion->save();

        return $devotion;
    }

    /**
     * Attach the given verse with the given data to the given devotion
     *
     * @param Devotion $devotion
     * @param Verse $verse
     * @param array $data
     * @return Verse
     */
    public function attachVerse(Devotion $devotion, Verse $verse, array $data): Verse
    {
        $verse->text = $data['text'];
        $verse->reference = $data['reference'];
        $verse->link = $data['link'];
        $verse->version = $data['version'];
        $verse->devotion()->associate($devotion);

        $verse->save();

        return $verse;
    }

    /**
     * Remove all verses (currently only one) from the devotion
     *
     * @param Devotion $devotion
     * @return Devotion
     */
    public function detatchVerses(Devotion $devotion): Devotion
    {
        $devotion->verse()->delete();

        return $devotion;
    }

    /**
     * Delete a devotion
     *
     * @param Devotion $devotion
     * @return void
     */
    public function destroy(Devotion $devotion): void
    {
        DB::transaction(function () use ($devotion) {
            $this->detatchVerses($devotion);

            $devotion->delete();
        });
    }

    /**
     * Get a Collection of "popular" Devotions
     *
     * @param integer $count
     * @return Collection
     */
    public function getPopular(int $count = 3): Collection
    {
        return Devotion::whereDate('date', '>=', Carbon::now()->subMonth())
            ->orderBy('view_count', 'desc')
            ->orderBy('date', 'desc')
            ->take($count)
            ->get();
    }
}