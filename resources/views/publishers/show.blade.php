@extends('layouts.app')

@section('title', 'Penerbit: ' . $publisher->name)

@section('content')
<div class="space-y-8">
    
    <div class="border p-6 flex items-center gap-4 bg-gray-50">
        <div class="w-16 h-16 bg-white border flex items-center justify-center overflow-hidden">
            @if($publisher->avatar)
                <img src="{{ asset('storage/' . $publisher->avatar) }}" class="w-full h-full object-cover">
            @else
                <span class="text-xs text-gray-400">LOGO</span>
            @endif
        </div>
        <div>
            <span class="text-xs uppercase text-gray-500 font-bold">Penerbit</span>
            <h1 class="text-2xl font-bold">{{ $publisher->name }}</h1>
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
                        <p class="text-xs text-gray-500 mb-3">{{ $book->author->name }}</p>
                        <a href="{{ route('books.show', $book->slug) }}" class="mt-auto border border-black text-center py-1.5 text-[10px] font-bold uppercase hover:bg-black hover:text-white transition">
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $books->links() }}</div>
    @else
        <div class="border-2 border-dashed p-12 text-center text-gray-400">Tidak ada buku dari penerbit ini.</div>
    @endif
</div>
@endsection