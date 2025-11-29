<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\License;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books      = Book::with(['category', 'publisher', 'author'])->filter($request->all())->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        $authors    = Author::orderBy('name')->get();
        $years      = Book::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('books.index', compact('books', 'categories', 'publishers', 'authors', 'years'));
    }

    public function show(Book $book)
    {
        $availableLicense = $book->licenses()->where('status', 'available')->count();
        return view('books.show', compact('book', 'availableLicense'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('books.create', compact('categories', 'authors', 'publishers'));
    }

    public function store(BookRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title'] . '-' . Str::random(4));
        $validated['pdf_file'] = $request->file('pdf_file')->store('books/pdfs', 'public');

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('books/covers', 'public');
        }

        $licenseCount = $validated['license_count'];
        unset($validated['license_count']);

        $book = Book::create($validated);

        for ($i = 0; $i < $licenseCount; $i++) {
            License::create(['book_id' => $book->id, 'status' => 'available']);
        }

        return redirect()->route('books.index')->with('success', 'Buku berhasil diterbitkan!');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('books.edit', compact('book', 'categories', 'authors', 'publishers'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $validated = $request->validated();

        if ($request->title !== $book->title) {
            $validated['slug'] = Str::slug($validated['title'] . '-' . Str::random(4));
        }

        if ($request->hasFile('pdf_file')) {
            if ($book->pdf_file) Storage::disk('public')->delete($book->pdf_file);
            $validated['pdf_file'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        if ($request->hasFile('cover')) {
            if ($book->cover) Storage::disk('public')->delete($book->cover);
            $validated['cover'] = $request->file('cover')->store('books/covers', 'public');
        }

        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Data buku diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->licenses()->where('status', 'borrowed')->exists()) {
            return back()->with('error', 'Gagal hapus! Masih ada user yang sedang membaca buku ini.');
        }

        if ($book->pdf_file) Storage::disk('public')->delete($book->pdf_file);
        if ($book->cover) Storage::disk('public')->delete($book->cover);

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku dihapus permanen.');
    }
}