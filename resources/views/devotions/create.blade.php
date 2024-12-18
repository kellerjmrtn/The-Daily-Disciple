<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Devotion') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-devotion-form action="{{ route('devotions.store') }}">
                    <x-slot name="submit">
                        <a
                            href="{{ route('dashboard') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded mr-4"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded shadow"
                        >
                            Create Devotion
                        </button>
                    </x-slot>
                </x-devotion-form>
            </div>
        </div>
    </div>
</x-app-layout>
