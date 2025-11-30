@extends('layouts.app')

@section('title', 'Daftar Penulis')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold border-b pb-4">Penulis Populer</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($authors as $author)
            <a href="{{ route('authors.show', $author->id) }}" class="border p-4 hover:border-black transition group text-center flex flex-col items-center gap-3">
                <div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden border">
                    @if($author->avatar)
                        <img src="{{ asset('storage/' . $author->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">IMG</div>
                    @endif
                </div>
                
                <div>
                    <h3 class="font-bold text-sm group-hover:underline line-clamp-1">{{ $author->name }}</h3>
                    <span class="text-xs text-gray-500">{{ $author->books_count }} Karya</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $authors->links() }}
    </div>
</div>
@endsection