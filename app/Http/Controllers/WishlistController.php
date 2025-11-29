<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with(['category', 'author'])->orderByPivot('created_at', 'desc')->paginate(12);
        return view('wishlists.index', compact('wishlists'));
    }

    public function store(Book $book)
    {
        Auth::user()->wishlists()->toggle($book->id);
        return back()->with('success', 'Buku ditambahkan ke wishlist.');
    }

    public function destroy(Book $book)
    {
        Auth::user()->wishlists()->detach($book->id);
        return back()->with('success', 'Buku dihapus dari wishlist.');
    }
}