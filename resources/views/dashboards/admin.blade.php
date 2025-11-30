@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex flex-col gap-6">
    
    <div class="flex justify-between items-end">
        <h1 class="text-2xl font-bold">Ringkasan Sistem</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="border p-4 flex flex-col justify-between h-32">
            <span>Total User</span>
            <span class="text-3xl font-bold">{{ $stats['total_users'] }}</span>
        </div>
        <div class="border p-4 flex flex-col justify-between h-32">
            <span>Total Buku</span>
            <span class="text-3xl font-bold">{{ $stats['total_books'] }}</span>
        </div>
        <div class="border p-4 flex flex-col justify-between h-32">
            <span>Total Kategori</span>
            <span class="text-3xl font-bold">{{ $stats['total_categories'] }}</span>
        </div>
        <div class="border p-4 flex flex-col justify-between h-32">
            <span>Sedang Dipinjam</span>
            <span class="text-3xl font-bold">{{ $stats['active_loans'] }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 border">
            <div class="p-4 border-b font-bold">Aktivitas Peminjaman Terbaru</div>
            <div class="p-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">User</th>
                            <th class="py-2">Buku</th>
                            <th class="py-2">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentActivities as $loan)
                        <tr class="border-b last:border-0">
                            <td class="py-2">{{ $loan->user->name }}</td>
                            <td class="py-2">{{ $loan->license->book->title }}</td>
                            <td class="py-2 text-sm">{{ $loan->loan_date->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1 border">
            <div class="p-4 border-b font-bold">Buku Terpopuler</div>
            <div class="p-4 flex flex-col gap-4">
                @foreach($popularBooks as $book)
                <div class="flex gap-3 items-center">
                    <div class="w-12 h-16 border flex items-center justify-center text-xs">Img</div>
                    <div class="flex-1 overflow-hidden">
                        <div class="font-bold truncate">{{ $book->title }}</div>
                        <div class="text-sm">{{ $book->borrowed_count }}x Dipinjam</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection