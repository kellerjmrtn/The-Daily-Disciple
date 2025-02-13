<?php

namespace App\View\Components\Devotion;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Verse extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly string $text,
        public readonly string $reference,
        public readonly string $version,
        public readonly string $link,
        public readonly bool $withoutFormatting = false,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.devotion.verse');
    }
}
