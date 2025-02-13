@if(!$withoutFormatting)
    <a
        class="devotion-heading-container"
        href="#{{ $urlHeading}}"
        id="{{ $urlHeading }}"
    >
        <{{ $tag }} class="devotion-heading">{{ $heading }}</{{ $tag }}>
        <div class="heading-link">
            <i class="fa-solid fa-link"></i>
        </div>
    </a>
@else
    <{{ $tag }} class="devotion-heading">{{ $heading }}</{{ $tag }}>
@endif
