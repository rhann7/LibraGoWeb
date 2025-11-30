@extends('layouts.dashboard')

@section('title', 'Dashboard Saya')

@section('content')
<div class="flex flex-col gap-6">
    
    <div class="flex justify-between items-end">
        <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}</h1>
        <a href="{{ route('books.index') }}" class="underline">Jelajahi Katalog</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        
        <div class="md:col-span-2 border p-4 flex gap-4 items-center h-32">
            @if($currentRead)
                <div class="w-16 h-24 border flex items-center justify-center text-xs">Img</div>
                <div>
                    <div class="text-xs uppercase font-bold mb-1">Sedang Dibaca</div>
                    <div class="font-bold truncate">{{ $currentRead->license->book->title }}</div>
                    <a href="{{ route('loans.store', $currentRead->license->book->slug) }}" class="text-sm underline mt-2 block">Lanjut Baca</a>
                </div>
            @else
                <div class="flex items-center justify-center w-full">
                    <span>Belum ada buku aktif. <a href="{{ route('books.index') }}" class="underline">Cari</a></span>
                </div>
            @endif
        </div>

        <div class="border p-4 flex flex-col justify-between h-32">
            <span>Buku Tamat</span>
            <span class="text-3xl font-bold">{{ $stats['books_read'] }}</span>
        </div>
        <div class="border p-4 flex flex-col justify-between h-32">
            <span>Koleksi (Fav/Bookmark)</span>
            <span class="text-3xl font-bold">{{ $stats['favorites'] + $stats['bookmarks'] }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 border">
            <div class="p-4 border-b flex justify-between">
                <span class="font-bold">Riwayat Terakhir</span>
                <a href="{{ route('histories.index') }}" class="text-sm underline">Semua</a>
            </div>
            <div class="p-4 flex flex-col gap-4">
                @foreach($recentHistories as $history)
                <div class="flex gap-3 items-center border-b pb-2 last:border-0">
                    <div class="w-12 h-16 border flex items-center justify-center text-xs">Img</div>
                    <div class="flex-1">
                        <div class="font-bold">{{ $history->license->book->title }}</div>
                        <div class="text-sm">Selesai: {{ $history->returned_date->format('d M Y') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-1 border">
            <div class="p-4 border-b font-bold">Ingin Dibaca</div>
            <div class="p-4 flex flex-col gap-4">
                @foreach($wishlist as $book)
                <div class="flex gap-3 items-center">
                    <div class="w-12 h-16 border flex items-center justify-center text-xs">Img</div>
                    <div class="flex-1 overflow-hidden">
                        <div class="font-bold truncate">{{ $book->title }}</div>
                        <a href="{{ route('loans.store', $book->slug) }}" class="text-sm underline">Pinjam</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection