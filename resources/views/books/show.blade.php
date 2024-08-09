<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <strong>Title:</strong> {{ $book->title }}
                </div>

                <div class="mb-4">
                    <strong>Category:</strong> {{ $book->category->category ?? 'N/A' }}
                </div>

                <div class="mb-4">
                    <strong>Description:</strong> {{ $book->description }}
                </div>

                <div class="mb-4">
                    <strong>Amount:</strong> {{ $book->books_amount }}
                </div>

                <!-- <div class="mb-4">
                    <strong>Book File:</strong>
                    <a href="{{ $book->book_file_url }}" class="text-blue-500 hover:underline" target="_blank">Download</a>
                </div> -->

                <div class="mb-4">
                    <strong>Cover Image:</strong>
                    <img src="{{ $book->cover_image_url }}" alt="Cover Image" style="width: 100px; height: 100px; object-fit: cover;">
                </div>

                <div class="flex mt-4">
                    <a href="{{ route('books.edit', $book->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mr-2">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>

                <div class="mt-4">
                    <a href="{{ route('books.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900">Back to List</a>
                    <a href="{{ route('books.export.pdf', $book->id) }}" class="bg-green-500 text-black px-4 py-2 rounded-md hover:bg-green-600">Export as PDF</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
