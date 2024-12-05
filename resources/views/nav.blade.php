<nav class="main-nav martel">
    <div class="nav-inner container mx-auto flex justify-between items-center py-4">
        <div>
            @if(!Route::is('index'))
                <a href="{{ route('index') }}" class="nav-link">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Today</span>
                </a>
            @else
                <div class="nav-date">
                    {{ Carbon\Carbon::now()->setTimezone('America/New_York')->format('F j, Y') }}
                    <span class="separator hidden md:inline-block"></span>
                    <strong class="hidden md:inline">The Power of Gratitude</strong>
                </div>
            @endif
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('devotions.index') }}" class="nav-link font-adjustment">
                <i class="fa-solid fa-layer-group"></i>
                <span>
                    All Devotions
                </span>
            </a>
            <a href="#" class="nav-link test-lin">
                <i class="fa-regular fa-user"></i>
                <span class="hidden sm:inline">
                    Login
                </span>
            </a>
        </div>
    </div>
</nav>
