@extends('layouts.app')

@section('content')

<div class="w-50 max-w-md mx-auto mt-10 bg-white p-6 rounded-md shadow-md">
    <h2 class="text-2xl font-bold text-center mb-5">Add New Person</h2>

    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/create" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   value="{{ old('username') }}" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <div class="text-center">
            <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-black rounded-md shadow-md hover:bg-blue-600">
                Submit
            </button>
        </div>
    </form>
</div>
@endsection