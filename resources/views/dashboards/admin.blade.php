@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-8">
    
    <h1 class="text-2xl font-bold">Dashboard Admin</h1>

    <div class="grid grid-cols-4 gap-4">
        <div class="border p-4 rounded">
            <h3>Total User</h3>
            <p class="text-2xl font-bold">{{ $stats['total_users'] }}</p>
        </div>
        <div class="border p-4 rounded">
            <h3>Total Buku</h3>
            <p class="text-2xl font-bold">{{ $stats['total_books'] }}</p>
        </div>
        <div class="border p-4 rounded">
            <h3>Total Kategori</h3>
            <p class="text-2xl font-bold">{{ $stats['total_categories'] }}</p>
        </div>
        <div class="border p-4 rounded">
            <h3>Sedang Dipinjam</h3>
            <p class="text-2xl font-bold">{{ $stats['active_loans'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-8">
        <div class="border p-4 rounded">
            <h2 class="text-xl font-bold mb-4">Peminjaman Terbaru</h2>
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th>User</th>
                        <th>Buku</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentActivities as $loan)
                    <tr class="border-b">
                        <td class="py-2">{{ $loan->user->name }}</td>
                        <td class="py-2">{{ $loan->license->book->title }}</td>
                        <td class="py-2 text-sm text-gray-500">{{ $loan->loan_date->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border p-4 rounded">
            <h2 class="text-xl font-bold mb-4">Buku Paling Sering Dipinjam</h2>
            <ul>
                @foreach($popularBooks as $book)
                <li class="mb-2 pb-2 border-b">
                    <strong>{{ $book->title }}</strong>
                    <br>
                    <span class="text-sm text-gray-600">Dipinjam: {{ $book->borrowed_count }} kali</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection