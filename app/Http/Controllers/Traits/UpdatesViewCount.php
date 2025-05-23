<?php

namespace App\Http\Controllers\Traits;

use App\Models\Devotion;
use Illuminate\Contracts\Session\Session;
use Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect;

trait UpdatesViewCount
{
    /**
     * The key used to track session view counts
     */
    public const SESSION_KEY = 'view_count_session_key';

    /**
     * Update the view count for the given $devotion. Returns true if the view count was
     * incremented
     *
     * @param Session $session
     * @param Devotion $devotion
     * @return bool
     */
    protected function updateViewCount(Session $session, Devotion $devotion): bool
    {
        // If the current user is a bot or crawler, ignore for view count purposes
        if (LaravelCrawlerDetect::isCrawler()) {
            return false;
        }

        $viewCountKey = static::SESSION_KEY . ':' . $devotion->id;

        // If no view count has been stored, store one
        if (!$session->has($viewCountKey)) {
            $devotion->increment('view_count');

            $session->put($viewCountKey, true);

            return true;
        }

        return false;
    }
}