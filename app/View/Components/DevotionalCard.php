<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DevotionalCard extends Component
{
    public bool $isToday;
    public bool $isYesterday;
    public bool $hasIcons;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $excerpt,
        public string $link,
        public Carbon $date,
        public ?string $subtitle = null,
        public ?string $scriptureReading = null,
        public bool $isPopular = false,
        public bool $isRecommended = false,
    ) {
        $this->isToday = $this->date->isSameDay(Carbon::now()->setTimezone('America/New_York'));
        $this->isYesterday = $this->date->isSameDay(Carbon::now()->setTimezone('America/New_York')->subDay());
        $this->hasIcons = $isPopular || $isRecommended;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.devotional-card');
    }
}
