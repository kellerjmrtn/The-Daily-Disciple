@if(!$withoutFormatting)
    <blockquote class="verse-container">
        <i class="verse-text">
            {{ $text }}
        </i>
        <a class="verse-reference" href="{{ $link }}" target="_blank">{{ $reference }} ({{ $version }})</a>
        <div class="clear-right"></div>
        <div class="copy-text-container">
            <button class="copy-text">
                <i class="fa-regular fa-copy"></i>
            </button>
        </div>
    </blockquote>
@else
    <p class="verse-text">{{ $text }} {{ $reference }} {{ $version }}</p>
@endif
