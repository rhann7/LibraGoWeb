@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')

<form action="{{ route('books.index') }}" method="GET" class="flex flex-col gap-8">

    <div class="border p-6 bg-white shadow-sm rounded-sm">
        
        <div class="flex gap-0 mb-4 border border-gray-300">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari judul buku..." 
                   class="grow p-3 outline-none focus:bg-gray-50 transition" autocomplete="off">
            <button type="submit" class="bg-black text-white px-8 font-bold text-sm uppercase hover:bg-gray-800 transition">
                Cari
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Kategori</label>
                <select name="category" class="w-full border border-gray-300 p-2 text-sm bg-white rounded-sm focus:border-black outline-none transition" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Penulis</label>
                <select name="author" class="w-full border border-gray-300 p-2 text-sm bg-white rounded-sm focus:border-black outline-none transition" onchange="this.form.submit()">
                    <option value="">Semua Penulis</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Penerbit</label>
                <select name="publisher" class="w-full border border-gray-300 p-2 text-sm bg-white rounded-sm focus:border-black outline-none transition" onchange="this.form.submit()">
                    <option value="">Semua Penerbit</option>
                    @foreach($publishers as $pub)
                        <option value="{{ $pub->id }}" {{ request('publisher') == $pub->id ? 'selected' : '' }}>
                            {{ $pub->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Tahun</label>
                <select name="year" class="w-full border border-gray-300 p-2 text-sm bg-white rounded-sm focus:border-black outline-none transition" onchange="this.form.submit()">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>
        
        @if(request()->anyFilled(['search', 'category', 'author', 'publisher', 'year']))
            <div class="mt-4 text-right border-t pt-2">
                <a href="{{ route('books.index') }}" class="text-xs text-red-600 hover:text-red-800 underline font-bold">
                    &times; Reset Semua Filter
                </a>
            </div>
        @endif
    </div>

    <div>
        <div class="flex justify-between items-end mb-4 border-b border-gray-200 pb-2">
            <h2 class="text-xl font-bold text-gray-800">Daftar Pustaka</h2>
            <span class="text-xs bg-gray-100 px-2 py-1 rounded font-mono text-gray-600">Total: {{ $books->total() }}</span>
        </div>

        @if($books->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($books as $book)
                    <div class="border border-gray-200 bg-white flex flex-col h-full hover:shadow-md hover:border-gray-400 transition group relative">
                        
                        <div class="aspect-2/3 bg-gray-100 w-full relative overflow-hidden border-b border-gray-100">
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Cover</div>
                            @endif
                            
                            <div class="absolute top-2 left-2 bg-black/80 text-white text-[10px] px-1.5 py-0.5 uppercase font-bold tracking-wider backdrop-blur-sm">
                                {{ $book->category->name }}
                            </div>
                        </div>

                        <div class="p-3 flex flex-col grow">
                            <h3 class="font-bold text-sm leading-tight mb-1 line-clamp-2 min-h-[2.5em]" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            <p class="text-xs text-gray-500 mb-3">{{ $book->author->name }}</p>
                            
                            <div class="mt-auto pt-2">
                                <a href="{{ route('books.show', $book->slug) }}" class="block w-full border border-black text-center py-1.5 text-[10px] font-bold uppercase text-black hover:bg-black hover:text-white transition tracking-wide">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $books->links() }}
            </div>
        @else
            <div class="border-2 border-dashed border-gray-200 rounded-sm p-12 text-center">
                <p class="text-gray-500">Tidak ada buku yang cocok dengan pencarianmu.</p>
                <a href="{{ route('books.index') }}" class="text-black underline text-sm mt-2 font-bold inline-block hover:text-blue-600">
                    Reset Filter
                </a>
            </div>
        @endif
    </div>

</form>

@endsection