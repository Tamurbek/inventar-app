@extends('layouts.app')

@section('content')
<div class="w-full max-w-[768px] min-w-[320px] bg-white p-6 rounded-md shadow-md">
    <div class="mb-4 d-flex justify-between">
        <h2 class="text-2xl font-bold text-center mb-5">Kategoriyalar</h2>
       <div class="flex flex-row items-center justify-center">
            <button onclick="openCreateModal()" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                + Yangi
            </button>
       </div>
    </div>
    
    @if (session('success'))
        <div class="mb-4 text-green-500">
            {{ session('success') }}
        </div>
    @endif

    <div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="min-w-[320] relative bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Yangi qo`shish</h2>
            <button id="closeCreateModal" class="absolute top-6 right-6 text-gray-600 hover:text-gray-800 text-2xl">X</button>
            <form id="createForm" action="/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="createName" class="block text-sm font-medium text-gray-700">Ism</label>
                    <input type="text" name="name" id="createName" class="w-full border border-gray-300 rounded-md p-2" required>
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
        <div class="min-w-[320px] relative bg-white p-6 rounded-lg shadow-lg w-1/3">
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


    <div class="grid grid-cols-1 gap-8 min-w-full">
        @forelse ($categories as $category)
            <div class="min-w-full max-w-full mx-auto bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-lg overflow-hidden">
                <div class="flex flex-row items-center justify-between gap-4 md:flex">
                    <div class="shrink-0">
                        @if($category->image)
                            <img class="w-48 h-30 object-contain md:h-30 md:w-48" src="{{ asset($category->image) }}" alt="Modern building architecture">
                        @endif
                    </div>
                    <div class="w-full p-3 flex flex-col md:flex-row gap-[1rem] items-center justify-between">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $category->name }}</div>
                        <div class="w-full flex flex-row gap-8 items-center justify-center">
                            <button class="text-blue-500 hover:underline flex flew-row items-center" onclick="openModal({{ $category->id }}, '{{ $category->name }}','{{ $category->image }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                                    <path d="M5.75234 19H16M8.78441 3.31171C8.78441 3.31171 8.78441 4.94634 10.419 6.58096C12.0537 8.21559 13.6883 8.21559 13.6883 8.21559M2.31963 15.9881L5.75234 15.4977C6.2475 15.4269 6.70636 15.1975 7.06004 14.8438L15.3229 6.58096C16.2257 5.67818 16.2257 4.21449 15.3229 3.31171L13.6883 1.67708C12.7855 0.774305 11.3218 0.774305 10.419 1.67708L2.15616 9.93996C1.80248 10.2936 1.57305 10.7525 1.50231 11.2477L1.01193 14.6804C0.902951 15.4432 1.5568 16.097 2.31963 15.9881Z" stroke="#28303F" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </button>
                            <form action="{{ route('category.delete', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline flex flew-row items-center" onclick="return confirm('Are you sure you want to delete this prod?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22" fill="none">
                                        <path d="M3 7V17C3 19.2091 4.79086 21 7 21H13C15.2091 21 17 19.2091 17 17V7M12 10V16M8 10L8 16M14 4L12.5937 1.8906C12.2228 1.3342 11.5983 1 10.9296 1H9.07037C8.40166 1 7.7772 1.3342 7.40627 1.8906L6 4M14 4H6M14 4H19M6 4H1" stroke="#28303F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <a href="{{route('product.getAll',$category->id)}}" class="bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Ko`rish
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-4">Ro`yxat bo`sh</div>
        @endforelse
    </div>

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
        function openModal(id, name, username, password,image=null) {
            console.log(image);
            
            document.getElementById('editModal').classList.remove('hidden');
            var url='/update/' + id;
            var path = '../public/';
            document.getElementById('editForm').action = url;
            document.getElementById('name').value = name;
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            document.getElementById('editImageView').src = `${path}/${image}`;
            console.log(image);   
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('editModal').classList.add('hidden');
        });
    </script>

    <script>
        // JavaScript to toggle the dropdown
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const searchInput = document.getElementById('search-input');
        let isOpen = false; // Set to true to open the dropdown by default
        
        // Function to toggle the dropdown state
        function toggleDropdown() {
            isOpen = !isOpen;
            dropdownMenu.classList.toggle('hidden', !isOpen);
        }
        
        // Set initial state
        toggleDropdown();
        
        dropdownButton.addEventListener('click', () => {
            toggleDropdown();
        });
        
        // Add event listener to filter items based on input
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const items = dropdownMenu.querySelectorAll('a');
        
            items.forEach((item) => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
            });
        });
    </script>

</div>
@endsection