<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="form-input mt-1 block w-full" value="{{ old('title', $book->title) }}" required>
                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-gray-700">Category</label>
                        <select name="categories_id" id="category" class="form-select mt-1 block w-full" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('categories_id', $book->categories_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" class="form-textarea mt-1 block w-full" required>{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="books_amount" class="block text-gray-700">Amount</label>
                        <input type="number" name="books_amount" id="books_amount" class="form-input mt-1 block w-full" value="{{ old('books_amount', $book->books_amount) }}" required>
                        @error('books_amount')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="books_file" class="block text-gray-700">Book File (PDF)</label>
                        <input type="file" name="books_file" id="books_file" class="form-input mt-1 block w-full" accept=".pdf">
                        @error('books_file')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="books_cover" class="block text-gray-700">Book Cover (JPEG/JPG/PNG)</label>
                        <input type="file" name="books_cover" id="books_cover" class="form-input mt-1 block w-full" accept="image/*">
                        @error('books_cover')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600">Update Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
