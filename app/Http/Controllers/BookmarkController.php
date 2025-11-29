<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Auth::user()->bookmarks()->with(['book.author', 'book.publisher'])->latest()->paginate(12);
        return view('bookmarks.index', compact('bookmarks'));
    }

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'page_number' => 'required|integer|min:1'
        ]);

        Bookmark::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $book->id],
            ['page_number' => $request->page_number]
        );

        return back()->with('success', 'Halaman berhasil ditandai.');
    }

    public function destroy(Bookmark $bookmark)
    {
        if ($bookmark->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $bookmark->delete();
        return back()->with('success', 'Bookmark dihapus.');
    }
}