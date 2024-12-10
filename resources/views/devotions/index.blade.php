@extends('layouts.app')

@section('navLeft')
    <a href="{{ route('index') }}" class="nav-link">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Today</span>
    </a>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="search-container mb-5 martel">
            <form action="" method="GET" class="search-form">
                <input
                    type="text"
                    class="search-box"
                    placeholder="Search"
                    name="search"
                    value="{{ $initialSearchValue }}"
                />
                <button class="search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="mb-5 devotional-card-container fade-in-up">
            @forelse ($devotions as $devotion)
                <x-devotion-card :devotion="$devotion" />
            @empty
                <div class="no-results bubble bg-gray-100 martel text-center">
                    No results
                </div>
            @endforelse
        </div>

        @if (method_exists($devotions, 'links') && $devotions->hasPages())
            <div class="bubble my-5 bg-gray-100 martel">
                {{ $devotions->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection