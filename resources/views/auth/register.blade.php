@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="flex justify-center items-center h-[60vh]">
    <div class="w-full max-w-md border p-8">
        <h2 class="text-xl font-bold mb-6 text-center">Registrasi LibraGo</h2>
        <form action="{{ route('store') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div>
                <label class="block mb-1">Nama</label>
                <input type="text" name="name" class="border w-full p-2" required>
            </div>
            <div>
                <label class="block mb-1">Username</label>
                <input type="text" name="username" class="border w-full p-2" required>
            </div>
            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" class="border w-full p-2" required>
            </div>
            <div>
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="border w-full p-2" required>
            </div>
            <button type="submit" class="border p-2 w-full font-bold">Daftar</button>
        </form>
        <div class="mt-4 text-center">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a></p>
        </div>
    </div>
</div>
@endsection