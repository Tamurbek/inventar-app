@extends('layouts.app1')

@section('content')

<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Ro`yxatdan o`tish</h2>
    <form method="POST" action="{{ route('signup.submit') }}">
        @csrf

        <!-- Full Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-2">Ism</label>
            <input type="text" id="name" name="name" placeholder="Ismingizni kiriting"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- login -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email" placeholder="Email kiriting"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">Parol</label>
            <input type="password" id="password" name="password" placeholder="Parol kiriting"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 mb-2">Parolni tasdiqlash</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Tasdiqlash uchun parolni kiriting"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition">
            Tasdiqalash
        </button>
    </form>

    <!-- Sign In Link -->
    <p class="mt-6 text-center text-gray-600">
        Ro`yxatdan o`tganmisiz?
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Kirish</a>
    </p>
</div>

@endsection