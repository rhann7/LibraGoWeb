<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->with(['category', 'author'])->orderByPivot('created_at', 'desc')->paginate(12);
        return view('favorites.index', compact('favorites'));
    }

    public function store(Book $book)
    {
        Auth::user()->favorites()->toggle($book->id);
        return back()->with('success', 'Buku ditambahkan ke favorit.');
    }

    public function destroy(Book $book)
    {
        Auth::user()->favorites()->detach($book->id);
        return back()->with('success', 'Buku dihapus dari favorit.');
    }
}
