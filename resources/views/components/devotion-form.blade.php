<form class="devotion-form" action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}">
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
        
        <x-form.quill name="content">
            {!! old('content', $devotion->content ?? '') !!}
        </x-form.quill>

        @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col sm:flex-row gap-6 mb-4">
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
                class="w-full border-gray-300 rounded"
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

        <div class="flex items-center sm:items-start sm:flex-col gap-x-3">
            <label for="is_recommended" class="block text-gray-700 font-medium sm:mb-2">Recommended</label>
            <input
                type="checkbox"
                id="is_recommended"
                name="is_recommended"
                value="1"
                {{ old('is_recommended', $devotion->is_recommended ?? false) ? 'checked' : '' }}
                class="rounded border-gray-300"
            />
            @error('is_recommended')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-4 flex">
        <div>
            <label for="user_id" class="block text-gray-700 font-medium mb-2">Author</label>
            <select
                id="user_id"
                name="user_id"
                class="w-full border-gray-300 rounded"
                required
            >
                @foreach ($authors as $author)
                    <option
                        value="{{ $author->id }}"
                        @if ($devotion->user_id === $author->id)selected @endif
                    >
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
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