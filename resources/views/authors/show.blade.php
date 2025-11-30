@extends('layouts.app')

@section('title', 'Penulis: ' . $author->name)

@section('content')
<div class="space-y-8">
    
    <div class="border p-6 flex flex-col md:flex-row items-center gap-6 bg-gray-50">
        <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden border shrink-0">
            @if($author->avatar)
                <img src="{{ asset('storage/' . $author->avatar) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">No IMG</div>
            @endif
        </div>
        <div class="text-center md:text-left">
            <h1 class="text-3xl font-bold">{{ $author->name }}</h1>
            <p class="text-gray-600 mt-1">Total {{ $books->total() }} buku diterbitkan di LibraGo.</p>
        </div>
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
                        <h3 class="font-bold text-sm leading-tight mb-1 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-xs text-gray-500 mb-3">{{ $book->year }}</p> <a href="{{ route('books.show', $book->slug) }}" class="mt-auto border border-black text-center py-1.5 text-[10px] font-bold uppercase hover:bg-black hover:text-white transition">
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $books->links() }}</div>
    @else
        <div class="border-2 border-dashed p-12 text-center text-gray-400">Penulis ini belum memiliki buku.</div>
    @endif
</div>
@endsection