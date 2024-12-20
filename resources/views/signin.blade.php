@extends('layouts.app1')

@section('content')

<div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-3xl font-bold text-center text-white mb-6">Kirish</h2>
    <form method="POST" action="{{ route('signin.submit') }}">
        @csrf
        <!-- Email Input -->
        <div class="mb-4">
            <label for="email" class="block text-white mb-2">Email</label>
            <input type="text" id="email" name="email" placeholder="Email kiriting"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-white mb-2">Parol</label>
            <input type="password" id="password" name="password" placeholder="Parol kiriting"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- <!-- Remember Me -->
        <div class="flex justify-between items-center mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember">
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>
            <a href="#" class="text-blue-500 hover:underline">Forgot Password?</a>
        </div> --}}

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">
            Sign In
        </button>
    </form>

    <!-- Sign Up Link -->
    <p class="mt-6 text-center text-gray-600">
        Akkuntingiz yo`qmi?
        <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Ro`yxatdan o`tish</a>
    </p>
</div>

@endsection