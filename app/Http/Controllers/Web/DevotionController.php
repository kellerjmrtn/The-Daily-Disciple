<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UpdatesViewCount;
use App\Http\Requests\StoreDevotionRequest;
use App\Http\Requests\UpdateDevotionRequest;
use App\Models\Devotion;
use App\Services\DevotionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DevotionController extends Controller
{
    use UpdatesViewCount;

    /**
     * Display a listing of the resource.
     */
    public function index(DevotionService $devotionService, Request $request)
    {
        $searchQuery = $request->query('search');

        // Public route, no perms check needed
        return view('devotions.index', [
            'devotions' => $devotionService->getSearchQuery($searchQuery)->visible()->paginate(24),
            'initialSearchValue' => $searchQuery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDevotionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DevotionService $devotionService, Devotion $devotion, Request $request)
    {
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
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devotion $devotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDevotionRequest $request, Devotion $devotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devotion $devotion)
    {
        //
    }
}
