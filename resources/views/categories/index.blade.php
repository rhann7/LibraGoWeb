@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold border-b pb-4">Semua Kategori</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', $category->id) }}" class="border p-6 hover:border-black transition group flex flex-col justify-between h-32">
                <h3 class="font-bold text-lg group-hover:underline">{{ $category->name }}</h3>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 self-start rounded">
                    {{ $category->books_count }} Buku
                </span>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection