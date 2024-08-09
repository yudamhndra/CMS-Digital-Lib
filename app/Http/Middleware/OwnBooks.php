<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Books;
use Illuminate\Support\Facades\Auth;

class OwnBooks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $book = Books::find($request->route('book'));

        if (Auth::user()->role !== 'admin' && Auth::id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You do not have permission to perform this action.');
        }

        return $next($request);
    }
}
