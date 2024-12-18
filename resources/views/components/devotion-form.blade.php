<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}">
    @csrf

    @if ($method !== 'GET' && $method !== 'POST')
        @method($method)
    @endif

    <div class="mb-4">
        <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $devotion->title ?? '') }}"
            class="w-full border-gray-300 rounded py-2 px-3"
            required
            autofocus
        />
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="subtitle" class="block text-gray-700 font-medium mb-2">Subtitle</label>
        <input
            type="text"
            id="subtitle"
            name="subtitle"
            value="{{ old('subtitle', $devotion->subtitle ?? '') }}"
            class="w-full border-gray-300 rounded py-2 px-3"
        />
        @error('subtitle')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
        <textarea
            id="content"
            name="content"
            rows="6"
            class="w-full border-gray-300 rounded py-2 px-3"
            required
        >{{ old('content', $devotion->content ?? '') }}</textarea>
        @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col sm:flex-row gap-6 mb-6">
        <div>
            <label for="date" class="block text-gray-700 font-medium mb-2">Date</label>
            <input
                type="date"
                id="date"
                name="date"
                value="{{ old('date', $devotion->date?->format('Y-m-d') ?? '') }}"
                class="w-full border-gray-300 rounded py-2 px-3"
                required
            />
            @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
            <select
                id="status"
                name="status"
                class="w-full border-gray-300 rounded py-2 px-3"
                required
            >
                @php $status = old('status', $devotion->status ?? ''); @endphp
                <option value="published" {{ $status === 'published' ? 'selected' : '' }}>Published</option>
                <option value="unpublished" {{ $status === 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <h3 class="font-semibold text-lg text-gray-800 mb-2">Main Verse</h3>

    <div class="mb-4">
        <label for="verse-text" class="block text-gray-700 font-medium mb-2">Verse Text</label>
        <textarea
            id="verse-text"
            name="verse-text"
            rows="6"
            class="w-full border-gray-300 rounded py-2 px-3"
        >{{ old('verse-text', $devotion->verse->text ?? '') }}</textarea>
        @error('verse-text')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col sm:flex-row gap-6 mb-6">
        <div class="mb-4">
            <label for="verse-reference" class="block text-gray-700 font-medium mb-2">Verse Reference</label>
            <input
                type="text"
                id="verse-reference"
                name="verse-reference"
                value="{{ old('verse-reference', $devotion->verse->reference ?? '') }}"
                class="w-full border-gray-300 rounded py-2 px-3"
            />
            @error('verse-reference')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="verse-version" class="block text-gray-700 font-medium mb-2">Verse Version</label>
            <input
                type="text"
                id="verse-version"
                name="verse-version"
                value="{{ old('verse-version', $devotion->verse->version ?? '') }}"
                class="w-full border-gray-300 rounded py-2 px-3"
            />
            @error('verse-version')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="verse-link" class="block text-gray-700 font-medium mb-2">Verse Link</label>
            <input
                type="text"
                id="verse-link"
                name="verse-link"
                value="{{ old('verse-link', $devotion->verse->link ?? '') }}"
                class="w-full border-gray-300 rounded py-2 px-3"
            />
            @error('verse-link')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    @isset($submit)
        <div class="flex items-center justify-end">
            {{ $submit }}
        </div>
    @endisset
</form>