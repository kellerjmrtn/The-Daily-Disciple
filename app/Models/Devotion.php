<?php

namespace App\Models;

use App\Enum\Status;
use App\Services\DevotionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devotion extends Model
{
    /** @use HasFactory<\Database\Factories\DevotionFactory> */
    use HasFactory;

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Is this devotion publicly visible
     *
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->status === 'published' && $this->date <= Carbon::now();
    }

    /**
     * Excerpt accessor
     *
     * @return Attribute
     */
    public function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->content,
        );
    }

    /**
     * Publicly visible route accessor
     *
     * @return Attribute
     */
    public function route(): Attribute
    {
        return Attribute::make(
            get: fn () => route('devotions.show', ['devotion' => $this]),
        );
    }

    /**
     * Is this today's devotion?
     *
     * @return Attribute
     */
    public function isToday(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date->isSameDay(Carbon::now()->setTimezone('America/New_York')),
        );
    }

    /**
     * Is this yesterday's devotion?
     *
     * @return Attribute
     */
    public function isYesterday(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date->isSameDay(Carbon::now()->setTimezone('America/New_York')->subDay()),
        );
    }

    /**
     * Is this tomorrow's devotion?
     *
     * @return Attribute
     */
    public function isTomorrow(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date->isSameDay(Carbon::now()->setTimezone('America/New_York')->addDay()),
        );
    }

    /**
     * Is this devotion popular?
     *
     * @return Attribute
     */
    public function isPopular(): Attribute
    {
        return Attribute::make(
            get: fn() => app(DevotionService::class)->getPopular(3)->contains($this),
        );
    }

    /**
     * Scope devotions to ones which are published
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', Status::PUBLISHED);
    }

    /**
     * Scope devotions to those whose date is today or earlier
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeReleased(Builder $query): Builder
    {
        return $query->releasedBefore(Carbon::now());
    }

    /**
     * Scope devotions to those whose date is equal to or before the given date
     *
     * @param Builder $query
     * @param Carbon $date
     * @return Builder
     */
    public function scopeReleasedBefore(Builder $query, Carbon $date): Builder
    {
        return $query->whereDate('date', '<=', $date);
    }

    /**
     * Scope devotions to those which are publicly visible
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->published()->released();
    }
}
