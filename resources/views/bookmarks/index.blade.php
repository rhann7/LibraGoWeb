@extends('layouts.app')
@section('title', 'Bookmark Saya')
@section('content')

<div class="border p-6 bg-white min-h-[50vh]">
    <h1 class="text-2xl font-bold border-b pb-4 mb-6">Penanda Halaman 📌</h1>

    @if($bookmarks->count() > 0)
        <div class="flex flex-col gap-4">
            @foreach($bookmarks as $bookmark)
                <div class="border p-4 flex items-start gap-4 hover:bg-gray-50 transition relative">
                    <div class="w-16 h-24 bg-gray-200 border shrink-0 overflow-hidden">
                        @if($bookmark->book->cover)
                            <img src="{{ asset('storage/' . $bookmark->book->cover) }}" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <div class="flex-1">
                        <h3 class="font-bold text-lg">
                            <a href="{{ route('books.show', $bookmark->book->slug) }}" class="hover:underline">
                                {{ $bookmark->book->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $bookmark->book->author->name }}</p>
                        
                        <div class="inline-block border bg-yellow-50 px-3 py-1 text-sm font-bold border-yellow-200 text-yellow-800">
                            Halaman: {{ $bookmark->page_number }}
                        </div>
                        <p class="text-xs text-gray-400 mt-2">
                            Disimpan pada: {{ $bookmark->updated_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST" onsubmit="return confirm('Hapus bookmark ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 text-xs border border-red-200 px-2 py-1 hover:bg-red-500 hover:text-white transition">
                            Hapus
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $bookmarks->links() }}</div>
    @else
        <div class="border-2 border-dashed p-10 text-center text-gray-400">
            Belum ada bookmark tersimpan.
        </div>
    @endif
</div>
@endsection