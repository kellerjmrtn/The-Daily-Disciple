<?php

namespace App\View\Components;

use App\Models\Devotion;
use App\Services\DevotionService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class DevotionForm extends Component
{
    public iterable $authors;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected DevotionService $devotionService,
        public string $action,
        public ?Devotion $devotion = null,
        public string $method = 'POST',
    ) {
        // For now, only the previous author or current user can be an author
        $this->authors = $devotionService->getAvailableAuthorsFor(Auth::user(), $devotion);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.devotion-form');
    }
}
