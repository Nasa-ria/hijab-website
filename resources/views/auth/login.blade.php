@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4">Login</h1>
            <p class="text-gray-600 mb-6">Access your customer account to place orders and leave reviews.</p>

            <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 border border-gray-300 rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-bold mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-gray-700">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-purple-700 transition">Log In</button>
            </form>

            <p class="text-center text-gray-600 mt-6">Don't have an account? <a href="{{ route('register') }}" class="text-purple-600 hover:underline">Register here</a>.</p>
        </div>
    </div>
</div>
@endsection