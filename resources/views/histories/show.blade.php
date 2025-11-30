@extends('layouts.app')
@section('title', 'Detail Riwayat')
@section('content')

<div class="max-w-2xl mx-auto border p-8 bg-white shadow-sm mt-10">
    
    <div class="text-center mb-8 border-b pb-4">
        <h1 class="text-2xl font-bold uppercase tracking-wide">Bukti Peminjaman</h1>
        <p class="text-gray-500 text-sm">ID Transaksi: #{{ $loan->id }}</p>
    </div>

    <div class="flex gap-6 mb-8">
        <div class="w-24 h-36 bg-gray-200 border shrink-0">
            @if($loan->license->book->cover)
                <img src="{{ asset('storage/' . $loan->license->book->cover) }}" class="w-full h-full object-cover">
            @endif
        </div>
        
        <div class="flex-1 space-y-2">
            <div>
                <span class="text-xs text-gray-500 uppercase font-bold">Judul Buku</span>
                <div class="text-lg font-bold">{{ $loan->license->book->title }}</div>
            </div>
            <div>
                <span class="text-xs text-gray-500 uppercase font-bold">Penulis</span>
                <div>{{ $loan->license->book->author->name }}</div>
            </div>
            <div>
                <span class="text-xs text-gray-500 uppercase font-bold">Kategori</span>
                <div>{{ $loan->license->book->category->name }}</div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 p-4 border mb-8">
        <div class="flex justify-between mb-2">
            <span class="text-sm text-gray-600">Tanggal Pinjam</span>
            <span class="font-bold">{{ $loan->loan_date->format('d F Y, H:i') }}</span>
        </div>
        <div class="flex justify-between mb-2">
            <span class="text-sm text-gray-600">Tanggal Kembali</span>
            <span class="font-bold">{{ $loan->returned_date->format('d F Y, H:i') }}</span>
        </div>
        <div class="border-t pt-2 mt-2 flex justify-between">
            <span class="text-sm text-gray-600">Status</span>
            <span class="font-bold text-green-600 uppercase">Selesai / Dikembalikan</span>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('histories.index') }}" class="text-sm underline text-gray-500 hover:text-black">
            &larr; Kembali ke Daftar Riwayat
        </a>
    </div>

</div>
@endsection