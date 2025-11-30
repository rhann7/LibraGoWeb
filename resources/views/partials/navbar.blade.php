<nav class="border-b h-16 bg-white">
    <div class="container mx-auto px-4 h-full flex justify-between items-center">
        <div>
            <a href="{{ url('/') }}" class="font-bold text-lg">LibraGo</a>
        </div>

        <div class="hidden md:flex gap-6">
            <a href="{{ url('/') }}" class="hover:underline">Home</a>
            <a href="{{ route('books.index') }}" class="hover:underline">Buku</a>
            <a href="{{ route('categories.index') }}" class="hover:underline">Kategori</a>
            <a href="{{ route('authors.index') }}" class="hover:underline">Penulis</a>
            <a href="{{ route('publishers.index') }}" class="hover:underline">Penerbit</a>
        </div>

        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="hover:underline">Masuk</a>
                <a href="{{ route('register') }}" class="border px-4 py-2 hover:bg-gray-50">Daftar</a>
            @else
                <div class="relative">
                    <details class="group">
                        <summary class="cursor-pointer list-none flex items-center gap-2 select-none">
                            Halo, {{ Auth::user()->name }}
                            <span class="text-xs">▼</span>
                        </summary>

                        <div class="absolute right-0 top-full mt-2 w-48 border bg-white p-2 z-50 shadow-sm">
                            
                            <a href="{{ route('dashboard') }}" class="block p-2 hover:bg-gray-100">Dashboard</a>

                            @if (Auth::user()->isUser())
                                <a href="{{ route('profile') }}" class="block p-2 hover:bg-gray-100">Edit Profil</a>
                            @endif
                            
                            <hr class="my-1 border-t">

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left p-2 hover:bg-gray-100 text-red-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </details>
                </div>
            @endguest
        </div>
    </div>
</nav>