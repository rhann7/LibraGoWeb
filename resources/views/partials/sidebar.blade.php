<div class="p-4 flex flex-col gap-4">

    @if(Auth::user()->role === 'user')
    <div class="flex flex-col gap-1">
        <span class="text-xs font-bold uppercase mb-2">Menu Utama</span>
        <a href="{{ route('dashboard') }}" class="p-2 border block">Dashboard</a>
        <a href="{{ route('profile') }}" class="p-2 border block">Edit Profil</a>
        <a href="{{ route('books.index') }}" class="p-2 border block">Cari Buku</a>
        <a href="{{ route('favorites.index') }}" class="p-2 border block">Favorit</a>
        <a href="{{ route('wishlists.index') }}" class="p-2 border block">Wishlist</a>
        <a href="{{ route('bookmarks.index') }}" class="p-2 border block">Bookmark</a>
        <a href="{{ route('histories.index') }}" class="p-2 border block">Riwayat</a>
    </div>
    @endif
    
    @if(Auth::user()->role === 'admin')
    <div class="flex flex-col gap-1">
        <span class="text-xs font-bold uppercase mb-2">Menu Utama</span>
        <a href="{{ route('dashboard') }}" class="p-2 border block">Dashboard</a>
        <a href="{{ route('profile') }}" class="p-2 border block">Edit Profil</a>
        <a href="{{ route('users.index') }}" class="p-2 border block">Users</a>
        <a href="{{ route('books.index') }}" class="p-2 border block">Buku</a>
        <a href="{{ route('categories.index') }}" class="p-2 border block">Kategori</a>
        <a href="{{ route('authors.index') }}" class="p-2 border block">Penulis</a>
        <a href="{{ route('publishers.index') }}" class="p-2 border block">Penerbit</a>
    </div>
    @endif

</div>