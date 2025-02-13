<?php

namespace App\View\Components\Devotion;

use App\Classes\Interfaces\VerseLinkGenerator;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Verse extends Component
{
    public string $link;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly string $text,
        public readonly string $reference,
        public readonly string $version,
        protected readonly VerseLinkGenerator $verseLinkGenerator,
        public readonly bool $withoutFormatting = false,
    ) {
        $this->link = $verseLinkGenerator->generate($reference, $version);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.devotion.verse');
    }
}
