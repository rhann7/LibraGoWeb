<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->latest()->paginate(12);
        return view('authors.index', compact('authors'));
    }

    public function show(Author $author)
    {
        $books = $author->books()->latest()->paginate(12);
        return view('authors.show', compact('author', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('authors', 'public');
        }

        Author::create($validated);
        return back()->with('success', 'Penulis ditambahkan.');
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            if ($author->avatar && Storage::disk('public')->exists($author->avatar)) {
                Storage::disk('public')->delete($author->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('authors', 'public');
        }

        $author->update($validated);
        return back()->with('success', 'Data penulis diperbarui.');
    }

    public function destroy(Author $author)
    {
        if ($author->books()->exists()) {
            return back()->with('error', 'Gagal hapus. Penulis ini punya buku terdaftar.');
        }

        if ($author->avatar) {
            Storage::disk('public')->delete($author->avatar);
        }

        $author->delete();
        return back()->with('success', 'Penulis dihapus.');
    }
}