<nav class="bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex justify-between h-16 items-center">

            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="font-bold text-xl text-gray-800">
                    LibraGo
                </a>
            </div>

            <div class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-gray-900">Buku</a>
                <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">Kategori</a>
                <a href="{{ route('authors.index') }}" class="text-gray-600 hover:text-gray-900">Penulis</a>
                <a href="{{ route('publishers.index') }}" class="text-gray-600 hover:text-gray-900">Penerbit</a>
            </div>

            <div class="flex items-center">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 mr-4">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Daftar</a>
                @else
                    <div class="relative ml-3">
                        <details class="group">
                            <summary class="list-none cursor-pointer flex items-center text-gray-700 font-medium">
                                Halo, {{ Auth::user()->name }}
                                <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </summary>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50 hidden group-open:block">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profil</a>
                                <div class="border-t border-gray-100"></div>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </details>
                    </div>
                @endguest
            </div>

        </div>
    </div>
</nav>