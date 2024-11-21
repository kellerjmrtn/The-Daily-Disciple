<nav class="main-nav">
    <div class="nav-inner container mx-auto flex justify-between items-center py-4">
        <div>
            @if(!Route::is('index'))
                <a href="{{ route('index') }}" class="nav-link">
                    <i class="fa-solid fa-book"></i>
                    Today's Reading
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
            <a href="{{ route('devotions.index') }}" class="nav-link">All Devotions</a>
            <a href="#" class="nav-link">
                <i class="fa-regular fa-user"></i>
                <div class="hidden sm:inline">
                    Login
                </div>
            </a>
        </div>
    </div>
</nav>
