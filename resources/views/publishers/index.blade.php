@extends('layouts.app')

@section('title', 'Daftar Penerbit')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold border-b pb-4">Penerbit Mitra</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($publishers as $publisher)
            <a href="{{ route('publishers.show', $publisher->id) }}" class="border p-4 hover:border-black transition group flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-100 border shrink-0 flex items-center justify-center overflow-hidden">
                    @if($publisher->avatar)
                        <img src="{{ asset('storage/' . $publisher->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-[10px] text-gray-400">LOGO</span>
                    @endif
                </div>
                
                <div class="overflow-hidden">
                    <h3 class="font-bold text-sm group-hover:underline truncate">{{ $publisher->name }}</h3>
                    <span class="text-xs text-gray-500">{{ $publisher->books_count }} Buku</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $publishers->links() }}
    </div>
</div>
@endsection