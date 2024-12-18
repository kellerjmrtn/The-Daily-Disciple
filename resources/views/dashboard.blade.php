<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Devotions') }}
            </h2>
        
            <a
                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded shadow"
                href="{{ route('devotions.create') }}"
            >
                <i class="fa-solid fa-plus mr-2"></i>
                {{ __('New Devotion') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="search-container mb-6 mx-5 sm:mx-0">
                <form action="" method="GET" class="search-form">
                    <input
                        type="text"
                        class="search-box border-gray-200"
                        placeholder="Search"
                        name="search"
                        value="{{ $initialSearchValue }}"
                    />
                    <button class="search-button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 overflow-x-scroll">
                    <table class="devotions-table w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="text-left text-lg font-medium text-gray-900 py-3 px-4">Title</th>
                                <th class="text-left text-lg font-medium text-gray-900 py-3 px-4">Subtitle</th>
                                <th class="text-left text-lg font-medium text-gray-900 py-3 px-4">Date</th>
                                <th class="text-left text-lg font-medium text-gray-900 py-3 px-4">Status</th>
                                <th class="text-left text-lg font-medium text-gray-900 py-3 px-4">Views</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @forelse($devotions as $devotion)
                                <tr class="border-b
                                    @if ($devotion->isToday)
                                        @if ($devotion->status === 'published')
                                            bg-green-100 hover:bg-green-200
                                        @else
                                            bg-red-100 hover:bg-red-200
                                        @endif
                                    @elseif($devotion->isTomorrow && $devotion->status !== 'published')
                                        bg-yellow-100 hover:bg-yellow-200
                                    @else
                                        bg-white hover:bg-gray-100
                                    @endif"
                                >
                                    <td class="py-3 px-4">{{ $devotion->title }}</td>
                                    <td class="py-3 px-4">{{ $devotion->subtitle }}</td>
                                    <td class="py-3 px-4">{{ $devotion->date->format('n/j/Y') }}</td>
                                    <td class="py-3 px-4">{{ $devotion->status }}</td>
                                    <td class="py-3 px-4">{{ $devotion->view_count }}</td>
                                    <td class="py-3 px-4 text-gray-900">
                                        <a
                                            href="{{ route('devotions.show', ['devotion' => $devotion]) }}"
                                            target="_blank"
                                        >
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('devotions.edit', ['devotion'=> $devotion]) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                    <td class="py-3 px-4 text-red-600">
                                        <form
                                            action="{{ route('devotions.destroy', ['devotion' => $devotion ]) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 px-4 text-center text-gray-500">No results</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if (method_exists($devotions, 'links') && $devotions->hasPages())
                <div class="p-4 my-6 shadow-sm sm:rounded-lg bg-white">
                    {{ $devotions->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
