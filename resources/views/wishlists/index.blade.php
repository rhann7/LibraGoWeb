@extends('layouts.app')
@section('title', 'Wishlist Saya')
@section('content')

<div class="border p-6 bg-white min-h-[50vh]">
    <h1 class="text-2xl font-bold border-b pb-4 mb-6">Ingin Dibaca (Wishlist) 🔖</h1>

    @if($wishlists->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($wishlists as $book)
                <div class="border flex flex-col h-full hover:border-black transition group relative">
                    <div class="aspect-2/3 bg-gray-100 relative border-b w-full flex items-center justify-center overflow-hidden">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-xs text-gray-400">No Cover</span>
                        @endif
                    </div>
                    <div class="p-3 flex flex-col grow">
                        <h3 class="font-bold text-sm mb-1 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-xs text-gray-500 mb-3">{{ $book->author->name }}</p>
                        <a href="{{ route('loans.store', $book->slug) }}" class="mt-auto border border-blue-600 text-blue-600 text-center py-1.5 text-xs font-bold uppercase hover:bg-blue-600 hover:text-white transition">
                            Pinjam Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $wishlists->links() }}</div>
    @else
        <div class="border-2 border-dashed p-10 text-center text-gray-400">
            Wishlist kosong.
        </div>
    @endif
</div>
@endsection