@extends('layouts.app')
@section('title', 'Riwayat Bacaan')
@section('content')

<div class="border p-6 bg-white min-h-[50vh]">
    <h1 class="text-2xl font-bold border-b pb-4 mb-6">Riwayat Peminjaman 📜</h1>

    @if($histories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-sm uppercase">
                        <th class="p-3 font-bold text-gray-600">Buku</th>
                        <th class="p-3 font-bold text-gray-600">Dipinjam</th>
                        <th class="p-3 font-bold text-gray-600">Dikembalikan</th>
                        <th class="p-3 font-bold text-gray-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                <div class="font-bold">{{ $history->license->book->title }}</div>
                                <div class="text-xs text-gray-500">{{ $history->license->book->author->name }}</div>
                            </td>
                            <td class="p-3 text-sm">
                                {{ $history->loan_date->format('d M Y') }}
                            </td>
                            <td class="p-3 text-sm">
                                {{ $history->returned_date->format('d M Y') }}
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('histories.show', $history->id) }}" class="border px-3 py-1 text-xs font-bold hover:bg-black hover:text-white transition">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $histories->links() }}</div>
    @else
        <div class="border-2 border-dashed p-10 text-center text-gray-400">
            Belum ada riwayat bacaan.
        </div>
    @endif
</div>
@endsection