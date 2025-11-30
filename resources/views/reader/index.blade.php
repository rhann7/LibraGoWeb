<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membaca: {{ $book->title }}</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { overflow: hidden; } 
    </style>
</head>
<body class="h-screen flex flex-col bg-gray-100 text-gray-800">

    <header class="h-16 flex items-center justify-between px-6 border-b border-gray-300 bg-white shadow-sm shrink-0">
        
        <div class="flex items-center gap-4">
            <a href="{{ route('books.show', $book->slug) }}" class="flex items-center gap-2 text-gray-600 hover:text-black transition text-sm font-bold">
                <span>&larr;</span> Kembali ke Detail
            </a>
            <div class="h-6 w-px bg-gray-300 mx-2"></div> <h1 class="font-bold text-lg truncate max-w-xs md:max-w-md text-gray-900">
                {{ $book->title }}
            </h1>
        </div>

        <div class="hidden md:block text-xs text-gray-400 uppercase font-bold tracking-wider">
            Mode Membaca
        </div>

        <div class="flex items-center gap-3">
            
            <form action="{{ route('bookmarks.store', $book->id) }}" method="POST" class="flex items-center gap-2 bg-gray-50 p-1 rounded border border-gray-200">
                @csrf
                <span class="text-xs text-gray-500 pl-2">Hal:</span>
                <input type="number" name="page_number" placeholder="-" min="1" required
                       class="w-12 bg-white border border-gray-300 rounded px-1 py-1 text-center text-sm focus:border-blue-500 outline-none">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-bold transition">
                    Simpan
                </button>
            </form>

            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menyelesaikan sesi baca dan mengembalikan buku ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-50 text-red-600 border border-red-200 hover:bg-red-600 hover:text-white hover:border-red-600 px-4 py-2 rounded text-xs font-bold transition">
                    Selesai Baca
                </button>
            </form>

        </div>
    </header>

    <div class="flex-1 bg-gray-200 relative">
        <object data="{{ $file_url }}#page={{ $loan->last_page }}&toolbar=0" type="application/pdf" class="w-full h-full absolute inset-0"></object>
    </div>

</body>
</html>