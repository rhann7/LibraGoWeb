@extends('layouts.app')

@section('title', 'Kategori: ' . $category->name)

@section('content')
<div class="space-y-8">
    
    <div class="border-b pb-4 flex justify-between items-end">
        <div>
            <span class="text-xs uppercase text-gray-500 font-bold">Kategori</span>
            <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
        </div>
        <a href="{{ route('categories.index') }}" class="text-sm underline">Lihat Semua Kategori</a>
    </div>

    @if($books->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($books as $book)
                <div class="border border-gray-200 bg-white flex flex-col h-full hover:border-black transition group relative">
                    <div class="aspect-2/3 bg-gray-100 w-full relative overflow-hidden border-b border-gray-100">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Cover</div>
                        @endif
                    </div>
                    <div class="p-3 flex flex-col grow">
                        <h3 class="font-bold text-sm leading-tight mb-1 line-clamp-2" title="{{ $book->title }}">
                            {{ $book->title }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-3">{{ $book->author->name }}</p>
                        <a href="{{ route('books.show', $book->slug) }}" class="mt-auto border border-black text-center py-1.5 text-[10px] font-bold uppercase hover:bg-black hover:text-white transition">
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    @else
        <div class="border-2 border-dashed p-12 text-center text-gray-400">
            Belum ada buku di kategori ini.
        </div>
    @endif
</div>
@endsection