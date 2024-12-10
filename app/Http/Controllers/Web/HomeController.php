<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Devotion;
use App\Services\DevotionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index(DevotionService $devotionService)
    {
        $devotion = $devotionService->getToday();

        // If today's devotion isn't available, show most recent devotion
        if (!$devotion) {
            $devotion = Devotion::visible()->orderBy('date', 'desc')->first();
        }

        if (Gate::forUser(Auth::user())->denies('view', $devotion)) {
            abort(404);
        }

        return view('devotions.show', [
            'devotion' => $devotion,
            'continueReading' => $devotionService->getRelatedDevotionsFor($devotion),
        ]);
    }
}
