<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Books::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('categories_id', $request->category);
        }

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        $books = $query->paginate(10);
        $categories = Categories::all();

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'books_amount' => 'required|integer',
            'books_file' => 'required|file|mimes:pdf',
            'books_cover' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        $book = new Books($request->all());
        $book->user_id = Auth::id();

        if ($request->hasFile('books_file')) {
            $book->books_file = $request->file('books_file')->store('books/files', 'public');
        }
        if ($request->hasFile('books_cover')) {
            $book->books_cover = $request->file('books_cover')->store('books/covers', 'public');
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show($id)
    {
        $book = Books::findOrFail($id);

        if (!Auth::user()->isAdmin() && $book->user_id != Auth::id()) {
            abort(403);
        }

        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Books::findOrFail($id);
        $categories = Categories::all();

        if (!Auth::user()->isAdmin() && $book->user_id != Auth::id()) {
            abort(403);
        }

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Books::findOrFail($id);

        if (!Auth::user()->isAdmin() && $book->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'books_amount' => 'required|integer',
            'books_file' => 'nullable|file|mimes:pdf',
            'books_cover' => 'nullable|image|mimes:jpeg,jpg,png'
        ]);

        $book->fill($request->except(['books_file', 'books_cover']));

        if ($request->hasFile('books_file')) {
            $book->books_file = $request->file('books_file')->store('books/files', 'public');
        }
        if ($request->hasFile('books_cover')) {
            $book->books_cover = $request->file('books_cover')->store('books/covers', 'public');
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = Books::findOrFail($id);

        if (!Auth::user()->isAdmin() && $book->user_id != Auth::id()) {
            abort(403);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
    
    // protected $pdf;

    public function exportPDF($id)
    {
        $book = Books::findOrFail($id);

        // Use the PDF facade to load the view
        $pdf = FacadePdf::loadView('exports.book', compact('book'));

        return $pdf->download('book-details.pdf');
    }
}
