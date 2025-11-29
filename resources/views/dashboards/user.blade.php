@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
<div class="space-y-8">

    <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}!</h1>

    <div class="border p-6 rounded bg-gray-50">
        <h2 class="text-xl font-bold mb-4">Sedang Dibaca</h2>
        
        @if($currentRead)
            <div class="flex gap-4">
                <div class="w-24 h-32 bg-gray-300 flex items-center justify-center">
                    @if($currentRead->license->book->cover)
                        <img src="{{ asset('storage/' . $currentRead->license->book->cover) }}" class="w-full h-full object-cover">
                    @else
                        No Cover
                    @endif
                </div>
                
                <div>
                    <h3 class="text-lg font-bold">{{ $currentRead->license->book->title }}</h3>
                    <p>Penulis: {{ $currentRead->license->book->author->name }}</p>
                    <p class="mt-2">Halaman Terakhir: <strong>{{ $currentRead->last_page }}</strong></p>
                    
                    <div class="mt-4">
                        <a href="{{ route('loans.store', $currentRead->license->book->slug) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Lanjut Baca
                        </a>
                    </div>
                </div>
            </div>
        @else
            <p>Kamu sedang tidak membaca buku apapun.</p>
            <a href="{{ route('books.index') }}" class="text-blue-500 underline">Cari buku di katalog</a>
        @endif
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="border p-4 rounded text-center">
            <h3>Buku Tamat</h3>
            <p class="text-2xl font-bold">{{ $myStats['books_read'] }}</p>
        </div>
        <div class="border p-4 rounded text-center">
            <h3>Favorit</h3>
            <p class="text-2xl font-bold">{{ $myStats['favorites'] }}</p>
        </div>
        <div class="border p-4 rounded text-center">
            <h3>Bookmarks</h3>
            <p class="text-2xl font-bold">{{ $myStats['bookmarks'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-8">
        <div class="border p-4 rounded">
            <h2 class="text-lg font-bold mb-3">Riwayat Bacaan Terakhir</h2>
            @forelse($recentHistories as $history)
                <div class="mb-3 border-b pb-2">
                    <p class="font-bold">{{ $history->license->book->title }}</p>
                    <p class="text-sm text-gray-500">Selesai: {{ $history->returned_date->format('d M Y') }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada riwayat.</p>
            @endforelse
            <a href="{{ route('histories.index') }}" class="text-sm text-blue-500 underline">Lihat Semua</a>
        </div>

        <div class="border p-4 rounded">
            <h2 class="text-lg font-bold mb-3">Wishlist (Ingin Dibaca)</h2>
            @forelse($wishlist as $book)
                <div class="mb-3 border-b pb-2 flex justify-between items-center">
                    <div>
                        <p class="font-bold">{{ $book->title }}</p>
                        <p class="text-sm text-gray-500">{{ $book->author->name }}</p>
                    </div>
                    <a href="{{ route('loans.store', $book->slug) }}" class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Baca</a>
                </div>
            @empty
                <p class="text-gray-500">Wishlist kosong.</p>
            @endforelse
            <a href="{{ route('wishlists.index') }}" class="text-sm text-blue-500 underline">Lihat Semua</a>
        </div>
    </div>

</div>
@endsection