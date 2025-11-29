<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::withCount('books')->latest()->paginate(12);
        return view('publishers.index', compact('publishers'));
    }

    public function show(Publisher $publisher)
    {
        $books = $publisher->books()->latest()->paginate(12);
        return view('publishers.show', compact('publisher', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('publishers', 'public');
        }

        Publisher::create($validated);
        return back()->with('success', 'Penerbit ditambahkan.');
    }

    public function update(Request $request, Publisher $publisher)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            if ($publisher->avatar && Storage::disk('public')->exists($publisher->avatar)) {
                Storage::disk('public')->delete($publisher->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('publishers', 'public');
        }

        $publisher->update($validated);
        return back()->with('success', 'Data penerbit diperbarui.');
    }

    public function destroy(Publisher $publisher)
    {
        if ($publisher->books()->exists()) {
            return back()->with('error', 'Gagal hapus. Penerbit ini punya buku terdaftar.');
        }

        if ($publisher->avatar) {
            Storage::disk('public')->delete($publisher->avatar);
        }

        $publisher->delete();
        return back()->with('success', 'Penerbit dihapus.');
    }
}