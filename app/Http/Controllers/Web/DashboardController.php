<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Devotion;
use App\Services\DevotionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(DevotionService $devotionService, Request $request)
    {
        // If no view perms for devotions, redirect to profile edit page
        if (Gate::denies('viewAll', Devotion::class)) {
            redirect()->route('profile.edit');
        }

        $searchQuery = $request->query('search');

        // Public route, no perms check needed
        return view('dashboard', [
            'devotions' => $devotionService->getSearchQuery($searchQuery)->paginate(48),
            'initialSearchValue' => $searchQuery,
        ]);
    }
}
