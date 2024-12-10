<nav class="main-nav martel">
    <div class="nav-inner container mx-auto flex justify-between items-center py-4">
        <div>
            @yield('navLeft')
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
