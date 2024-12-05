<a
    href="{{ $link }}"
    class="devotional-card bubble"
    >
    <div class="card-upper">
        <div class="card-top">
            <p class="date-container aboreto">
                <span class="date">
                    {{ $date->format('n / j / Y')}}
                </span>
                @if ($isToday)
                    <span class="is-special-day today">Today</span>
                @elseif ($isYesterday)
                    <span class="is-special-day yesterday">Yesterday</span>
                @endif
            </p>
            @if ($hasIcons)
                <div class="icons">
                    @if ($isPopular)
                        <i class="fa-solid fa-chart-simple"></i>
                    @endif
                    @if ($isRecommended)
                        <i class="fa-solid fa-circle-check"></i>
                    @endif
                </div>
            @endif
        </div>
        <div class="card-middle">
            <div class="titles martel">
                <h2 class="title">{{ $title }}</h2>
                @if ($subtitle)
                    <h3 class="subtitle">{{ $subtitle }}</h3>
                @elseif($scriptureReading)
                    <i class="subtitle">{{ $scriptureReading }}</i>
                @endif
            </div>
            <div class="excerpt martel">
                {!! $excerpt !!}
            </div>
            <button
                class="go-to-link aboreto"
            >
                Read
            </button>
        </div>
    </div>
    <div class="card-lower">
        <button
            class="go-to-link aboreto"
        >
            Read
        </button>
        <button class="read-more">
            <i class="fa-solid fa-angle-down"></i>
        </button>
    </div>
</a>
