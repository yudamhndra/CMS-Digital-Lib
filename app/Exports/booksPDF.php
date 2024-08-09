<?php

namespace App\Exports;

use App\Models\Books;
use Barryvdh\DomPDF\Facade as PDF;

class BooksPDF
{
    public function export($bookId)
    {
        $book = Books::findOrFail($bookId);
        $pdf = PDF::loadView('exports.book', compact('book'));
        return $pdf->download('book-details.pdf');
    }
}
