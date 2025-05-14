<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UpdatesViewCount;
use App\Http\Requests\StoreDevotionRequest;
use App\Http\Requests\UpdateDevotionRequest;
use App\Models\Devotion;
use App\Services\DevotionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function create(Request $request)
    {
        if (Gate::forUser($request->user())->denies('create', Devotion::class)) {
            abort(403);
        }

        return view('devotions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DevotionService $devotionService, StoreDevotionRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($devotionService, $data) {
            $devotion = $devotionService->save(new Devotion(), $data);
        });

        // Redirect to the devotions index with a success message
        return redirect()->route('dashboard')->with('success', 'Devotion created successfully.');
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
            'title' => $devotion->title . ' | ' . $devotion->date->format('F j, Y'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devotion $devotion, Request $request)
    {
        if (Gate::forUser($request->user())->denies('update', $devotion)) {
            abort(403);
        }

        return view('devotions.edit', [
            'devotion' => $devotion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DevotionService $devotionService, UpdateDevotionRequest $request, Devotion $devotion)
    {
        $data = $request->validated();

        DB::transaction(function () use ($devotionService, $data, $devotion) {
            $devotion = $devotionService->save($devotion, $data);
        });

        // Redirect to the devotions index with a success message
        return redirect()->route('dashboard')->with('success', 'Devotion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DevotionService $devotionService, Devotion $devotion, Request $request)
    {
        if (Gate::forUser($request->user())->denies('delete', $devotion)) {
            abort(403);
        }

        $devotionService->destroy($devotion);

        // Redirect to the devotions index with a success message
        return redirect()->route('dashboard')->with('success', 'Devotion deleted successfully.');
    }
}
