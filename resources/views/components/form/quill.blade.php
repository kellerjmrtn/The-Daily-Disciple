<div {{ $attributes->merge(['class' => 'quill-editor']) }} data-name="{{ $name }}">
    {{ $slot }}
</div>

{{-- Ensure quill stylesheet is only added once per page --}}
@once
    @push('stylesheets')
        <!-- Include Quill stylesheet -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet" />
    @endpush
@endonce
