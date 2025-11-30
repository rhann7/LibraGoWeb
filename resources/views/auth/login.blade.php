@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex justify-center items-center h-[50vh]">
    <div class="w-full max-w-md border p-8">
        <h2 class="text-xl font-bold mb-6 text-center">Login LibraGo</h2>
        <form action="{{ route('auth') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" class="border w-full p-2" required>
            </div>
            <div>
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="border w-full p-2" required>
            </div>
            <button type="submit" class="border p-2 w-full font-bold">Login</button>
        </form>
        <div class="mt-4 text-center">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
        </div>
    </div>
</div>
@endsection