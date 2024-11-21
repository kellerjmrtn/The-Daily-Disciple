<?php

namespace App\View\Components\Devotion;

use Illuminate\Support\Str;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Heading extends Component
{
    /**
     * The slug version of the heading, for link generation purposes
     *
     * @var string
     */
    public string $urlHeading;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $heading)
    {
        $this->urlHeading = Str::slug(trim($heading));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.devotion.heading');
    }
}
