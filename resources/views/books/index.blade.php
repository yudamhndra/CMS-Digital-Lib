<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Filter Form -->
                <div class="flex mb-4 items-center justify-between">
                    <form action="{{ route('books.index') }}" method="GET" class="flex items-center space-x-2">
                        <select name="category" class="border-gray-300 rounded-md shadow-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600">Apply Filter</button>
                    </form>
                    <div class="space-x-2">
                        <a href="{{ route('categories.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900">Category</a>
                        <a href="{{ route('books.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600">Add New Book</a>
                    </div>
                </div>

                <!-- Books Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Title</th>
                                <th class="py-2 px-4 border-b">Category</th>
                                <th class="py-2 px-4 border-b">Description</th>
                                <th class="py-2 px-4 border-b">Amount</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                                    <td class="py-2 px-4 border-b">{{ $book->category->category ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border-b">{{ $book->description }}</td>
                                    <td class="py-2 px-4 border-b">{{ $book->books_amount }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="{{ route('books.show', $book->id) }}" class="text-blue-500 hover:underline">View</a> |
                                        <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
