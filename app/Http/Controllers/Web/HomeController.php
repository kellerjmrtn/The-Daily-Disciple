<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UpdatesViewCount;
use App\Models\Devotion;
use App\Services\DevotionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use UpdatesViewCount;

    public function index(DevotionService $devotionService, Request $request)
    {
        $devotion = $devotionService->getToday();

        // If today's devotion isn't available, show most recent devotion
        if (!$devotion) {
            $devotion = Devotion::visible()->orderBy('date', 'desc')->first();
        }

        $user = $request->user();

        if (Gate::forUser($user)->denies('view', $devotion)) {
            abort(404);
        }

        // Don't count admin views
        if (!$user || !$user->hasRole('admin')) {
            $this->updateViewCount($request->session(), $devotion);
        }

        return view('devotions.show', [
            'devotion' => $devotion,
            'continueReading' => $devotionService->getRelatedDevotionsFor($devotion),
            'title' => 'The Daily Disciple | Daily Devotionals'
        ]);
    }
}
