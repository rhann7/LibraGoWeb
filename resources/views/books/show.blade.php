@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="text-sm text-gray-500 mb-6 border-b pb-2">
        <a href="{{ url('/') }}" class="hover:underline">Home</a> / 
        <a href="{{ route('books.index') }}" class="hover:underline">Buku</a> / 
        <span class="text-black font-bold">{{ $book->title }}</span>
    </div>

    <div class="flex flex-col md:flex-row gap-10 items-start">
        <div class="w-48 md:w-64 shrink-0 mx-auto md:mx-0 bg-white border p-1 shadow-sm">
            <div class="aspect-2/3 bg-gray-100 w-full relative overflow-hidden flex items-center justify-center">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
                @else
                    <div class="text-gray-400 font-bold text-xs">No Cover</div>
                @endif
            </div>
        </div>

        <div class="flex-1 w-full space-y-6">
            
            <div>
                <span class="bg-black text-white text-xs px-2 py-1 font-bold uppercase tracking-wider mb-2 inline-block">
                    {{ $book->category->name }}
                </span>
                <h1 class="text-4xl font-bold text-gray-900 mb-1 leading-tight">{{ $book->title }}</h1>
                <div class="text-lg text-gray-600">Penulis: <span class="font-bold text-black">{{ $book->author->name }}</span></div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 border-y py-4">
                <div>
                    <div class="text-xs text-gray-500 uppercase font-bold">Penerbit</div>
                    <div class="text-sm font-medium">{{ $book->publisher->name }}</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 uppercase font-bold">Tahun</div>
                    <div class="text-sm font-medium">{{ $book->year }}</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 uppercase font-bold">Halaman</div>
                    <div class="text-sm font-medium">{{ $book->pages ?? '-' }}</div>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                @auth
                    @if(Auth::user()->hasActiveLoan($book->id))
                        <a href="{{ route('loans.store', $book->slug) }}" class="w-full bg-blue-600 text-white p-4 text-center font-bold uppercase hover:bg-blue-700 transition shadow-lg">
                            Lanjutkan Membaca
                        </a>
                    @else
                        @if($availableLicense > 0)
                            <a href="{{ route('loans.store', $book->slug) }}" class="w-full bg-black text-white p-4 text-center font-bold uppercase hover:bg-gray-800 transition shadow-lg">
                                Pinjam & Baca Sekarang
                            </a>
                        @else
                            <button disabled class="w-full bg-gray-200 text-gray-400 p-4 text-center font-bold uppercase cursor-not-allowed">
                                Stok Sedang Habis
                            </button>
                        @endif
                    @endif

                    <div class="flex gap-3">
                        <form action="{{ route('favorites.toggle', $book->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button class="w-full border border-gray-300 p-2 text-sm font-bold uppercase hover:border-red-500 hover:text-red-500 transition">
                                {{ Auth::user()->favorites->contains($book->id) ? '♥ Hapus Favorit' : '♡ Favorit' }}
                            </button>
                        </form>
                        <form action="{{ route('wishlists.toggle', $book->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button class="w-full border border-gray-300 p-2 text-sm font-bold uppercase hover:border-blue-500 hover:text-blue-500 transition">
                                {{ Auth::user()->wishlists->contains($book->id) ? '✔ di Wishlist' : '+ Wishlist' }}
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-gray-50 border border-dashed border-gray-300 p-6 text-center rounded">
                        <p class="text-gray-600 mb-2">Login untuk membaca buku ini.</p>
                        <a href="{{ route('login') }}" class="inline-block bg-black text-white px-6 py-2 text-sm font-bold uppercase hover:bg-gray-800">Masuk Akun</a>
                    </div>
                @endauth
            </div>

            <div>
                <h3 class="font-bold text-lg mb-2">Sinopsis</h3>
                <div class="text-gray-700 leading-relaxed text-justify">
                    {{ $book->description ?? 'Tidak ada deskripsi tersedia.' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection