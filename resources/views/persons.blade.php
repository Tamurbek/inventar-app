@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-md shadow-md">
    <div class="mb-4 d-flex">
        <h2 class="text-2xl font-bold text-center mb-5">Online ro`yxat</h2>
        <button onclick="openCreateModal()" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
            + Yangi
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-500">
            {{ session('success') }}
        </div>
    @endif

    <div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="relative bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Yangi qo`shish</h2>
            <button id="closeCreateModal" class="absolute top-6 right-6 text-gray-600 hover:text-gray-800 text-2xl">X</button>
            <form id="createForm" action="/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="createName" class="block text-sm font-medium text-gray-700">Ism</label>
                    <input type="text" name="name" id="createName" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="createUsername" class="block text-sm font-medium text-gray-700">Login</label>
                    <input type="tezt" name="username" id="createUsername" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="createPassword" class="block text-sm font-medium text-gray-700">Parol</label>
                    <input type="password" name="password" id="createPassword" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="createImage" class="block text-sm font-medium text-gray-700">Rasm</label>
                    <input type="file" name="image" id="createImage" class="w-full border border-gray-300 rounded-md p-2" accept="image/*">
                    <img id="createImageView" class="mt-4 hidden w-32 h-32 object-cover rounded-md" alt="Tanlangan rasm">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Saqlash</button>
                </div>
            </form>
        </div>
    </div>


    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="relative bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Tahrirlash</h2>
            <button id="closeModal" class="absolute top-6 right-6 text-gray-600 hover:text-gray-800 text-2xl">X</button>
            <form id="editForm" action="" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Ism</label>
                    <input type="text" name="name" id="name" value="" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Login</label>
                    <input type="username" name="username" id="username" value="" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Parol</label>
                    <input type="password" name="password" id="password" value="" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                  <div class="mb-4">
                    <label for="editImage" class="block text-sm font-medium text-gray-700">Rasm</label>
                    <input type="file" name="image" id="editImage" class="w-full border border-gray-300 rounded-md p-2" accept="image/*">
                    <img id="editImageView" class="mt-4 hidden w-32 h-32 object-cover rounded-md" alt="Tanlangan rasm">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Saqlash</button>
                </div>
            </form>
        </div>
    </div>


    <table class="min-w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Rasm</th>
                <th class="border border-gray-300 px-4 py-2">Ism</th>
                <th class="border border-gray-300 px-4 py-2">Login</th>
                <th class="border border-gray-300 px-4 py-2">Tahrir</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($people as $person)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $person->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($person->image)
                            <img src="{{ asset($person->image) }}" alt="Image" style="width: 100px; height: auto;">
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $person->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $person->username }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <button onclick="openModal(
                                                     {{ $person->id }}, 
                                                    '{{ $person->name }}', 
                                                    '{{ $person->username }}',
                                                    '{{ $person->image }}')" class="text-blue-500 hover:underline">Tahrir</button> |
                        <form action="{{ route('people.delete', $person->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this person?')">O`chirish</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">Ro`yxat bo`sh</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        document.getElementById('createImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('createImageView');
    
            if (file) {
                const reader = new FileReader();
    
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
    
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });

        document.getElementById('editImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('editImageView');
    
            if (file) {
                const reader = new FileReader();
    
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
    
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
    </script>

    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }
        document.getElementById('closeCreateModal').addEventListener('click', function() {
            document.getElementById('createModal').classList.add('hidden');
        });
    </script>

    <script>
        function openModal(id, name, username, password,image) {
            console.log(image);
            
            document.getElementById('editModal').classList.remove('hidden');
            var url='/update/' + id;
            document.getElementById('editForm').action = url;
            document.getElementById('name').value = name;
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            document.getElementById('editImage').value = image;
        }

        // Modalni yopish
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('editModal').classList.add('hidden');
        });
    </script>

</div>
@endsection