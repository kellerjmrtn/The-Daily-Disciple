@extends('layouts.app')

@section('title'){{ $devotion->date->format('F j, Y') }} | {{ $devotion->title }}@endsection

@section('navLeft')
    <div class="nav-date">
        {{ $devotion->date->format('F j, Y') }}
        <span class="separator hidden md:inline-block"></span>
        <strong class="hidden md:inline">{{ $devotion->title }}</strong>
    </div>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="bubble fade-in-up mb-5 banner">
            <img src="{{ asset('assets/banner.jpg') }}" class="banner-img" />
            <div class="banner-text">
                {{ $devotion->date->format('F j, Y') }}
            </div>
        </div>
        @if (!$devotion->isVisible())
            <div class="bubble my-5 bg-yellow-100 text-yellow-700 p-4 martel">
                Warning: This devotion is not publicly visible
            </div>
        @endif
        <div class="bubble my-5 devotional fade-in-up">
            <div class="devotional-container martel">
                <div class="headings">
                    <h1>{{ $devotion->title }}</h1>
                    @if ($devotion->subtitle)
                        <h2>{{ $devotion->subtitle }}</h2>
                    @endif
                    @if ($devotion->user)
                        <x-inline-author :user="$devotion->user" link />
                    @endif
                    <div class="heading-border"></div>
                </div>

                <x-render-devotion class="devotional-text" :html="$devotion->content" />
            </div>
        </div>
        <div class="bubble-break fade-in-up">
            <h2 class="break-heading martel">Continue Reading</h2>
        </div>
        <div class="devotional-card-container my-5 fade-in-up slider">
            @foreach ($continueReading as $devotional)
                <x-devotion-card :devotion="$devotional" />
            @endforeach
        </div>
    </div>
@endsection