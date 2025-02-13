<?php

namespace App\View\Components;

use App\Models\Devotion;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DevotionCard extends Component
{
    public bool $isToday;
    public bool $isYesterday;
    public bool $hasIcons;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public Devotion $devotion,
        public ?string $scriptureReading = null,
    ) {
        $this->isToday = $devotion->date->isSameDay(Carbon::now()->setTimezone('America/New_York'));
        $this->isYesterday = $devotion->date->isSameDay(Carbon::now()->setTimezone('America/New_York')->subDay());
        $this->hasIcons = $devotion->isPopular || $devotion->is_recommended;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.devotion-card');
    }
}
