<?php

namespace App\View\Components;

use App\Models\Devotion;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DevotionForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public ?Devotion $devotion = null,
        public string $method = 'POST',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.devotion-form');
    }
}
