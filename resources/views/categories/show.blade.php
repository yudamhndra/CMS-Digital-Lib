<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-lg font-medium">Category Name: {{ $category->name }}</p>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('categories.edit', $category) }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

