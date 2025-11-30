@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-10">

    <div class="border p-10 text-center bg-gray-50 flex flex-col items-center gap-4">
        <h1 class="text-3xl font-bold uppercase tracking-wide">Selamat Datang di LibraGo</h1>
        <p class="text-gray-600 max-w-xl">
            Perpustakaan digital modern untuk membaca tanpa batas. 
            Temukan ribuan koleksi buku dan baca langsung dari browser kamu.
        </p>
        
        <form action="{{ route('books.index') }}" method="GET" class="w-full max-w-lg flex gap-0 border border-gray-300 bg-white mt-4">
            <input type="text" name="search" placeholder="Mau baca apa hari ini?" 
                   class="grow p-3 outline-none">
            <button type="submit" class="bg-black text-white px-6 font-bold uppercase hover:bg-gray-800 transition">
                Cari
            </button>
        </form>
    </div>

    <div>
        <h2 class="font-bold text-lg mb-4 border-b pb-2 uppercase">Jelajahi Kategori</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($categories as $cat)
                <a href="{{ route('books.index', ['category' => $cat->id]) }}" 
                   class="border p-4 text-center hover:bg-black hover:text-white transition font-bold text-sm">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <div class="flex justify-between items-end mb-4 border-b pb-2">
            <h2 class="font-bold text-lg uppercase">Buku Terbaru</h2>
            <a href="{{ route('books.index') }}" class="text-xs underline font-bold">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($latestBooks as $book)
                <div class="border flex flex-col h-full group hover:border-black transition relative">
                    <div class="aspect-2/3 bg-gray-100 w-full relative border-b overflow-hidden">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 text-xs">No Cover</div>
                        @endif
                    </div>

                    <div class="p-3 flex flex-col grow">
                        <h3 class="font-bold text-sm leading-tight mb-1 line-clamp-2" title="{{ $book->title }}">
                            {{ $book->title }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-3">{{ $book->author->name }}</p>
                        <a href="{{ route('books.show', $book->slug) }}" class="mt-auto border border-gray-300 text-center py-1.5 text-[10px] font-bold uppercase hover:bg-black hover:text-white transition">
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection