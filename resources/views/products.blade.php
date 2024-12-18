@extends('layouts.app')

@section('content')
<div class="w-full max-w-[768px] min-w-[320px] bg-white p-6 rounded-md shadow-md">
    <div class="mb-4 d-flex justify-between">
        <h2 class="text-2xl font-bold text-center mb-5">Gullar</h2>
        <div class="flex flex-row items-center justify-between">
            <a href="{{route('category.getAll')}}" class="bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                Kategoriyalar
            </a>
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
        <div class="min-w-[320px] relative bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Yangi qo`shish</h2>
            <button id="closeCreateModal" class="absolute top-6 right-6 text-gray-600 hover:text-gray-800 text-2xl">X</button>
            <form id="createForm" action="/prod-create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="createName" class="block text-sm font-medium text-gray-700">Nomi</label>
                    <input type="text" name="name" id="createName" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="createPrice" class="block text-sm font-medium text-gray-700">Narxi</label>
                    <input type="number" name="price" value="0" id="createprice" class="w-full border border-gray-300 rounded-md p-2">
                </div>
                <div class="mb-4">
                    <label for="price_visible" class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" name="price_visible" id="price_visible" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Narxi korinmasin</span>
                    </label>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategoriya</label>
                    <select id="category_id" name="categories_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Kategoriyani tanlang</option>
                        @forelse ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @empty
                            <option value="">Kategoriya yo`q</option>
                        @endforelse
                    </select>
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


    <div id="editModal" class="min-w-md fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="min-w-md relative bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Tahrirlash</h2>
            <button id="closeModal" class="absolute top-6 right-6 text-gray-600 hover:text-gray-800 text-2xl">X</button>
            <form id="editForm" action="" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-700">Nomi</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div class="mb-4">
                    <label for="createPrice" class="block text-sm font-medium text-gray-700">Narxi</label>
                    <input type="text" name="price" id="price" class="w-full border border-gray-300 rounded-md p-2">
                </div>
                <div class="mb-4">
                    <label for="editPeopleId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategoriya</label>
                    <select id="editPeopleId" name="categories_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Kategoriyani tanlang</option>
                        @forelse ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @empty
                            <option value="">Kategoriya yo`q</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-4">
                    <label for="edit_price_visible" class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" name="price_visible" id="edit_price_visible" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Narxi ko`rinmasin</span>
                    </label>
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

    <div class="grid gap-8
                sm:grid-cols-1
                md:grid-cols-2
                lg:grid-cols-3">
        @forelse ($product as $prod)
            <div class="max-w-md h-[300px] mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="flex flex-col gap-4 md:flex">
                    <div class="md:shrink-0">
                        @if($prod->image)
                            <img class="h-[12rem] w-48 object-cover md:h-30 md:w-48" src="{{ asset($prod->image) }}" alt="Modern building architecture">
                        @endif
                    </div>
                    <div class="flex flex-col gap-[1.5rem] flex-wrap items-center justify-between">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $prod->name }}</div>
                        <div class="w-full flex flex-row items-center justify-around">
                            <button onclick="openModal(
                                                         {{ $prod->id }}, 
                                                        '{{ $prod->name }}', 
                                                        '{{ $prod->price }}',
                                                        '{{ $prod->price_visible }}',
                                                        '{{ $prod->category_id }}',
                                                        '{{ $prod->image }}')" class="text-blue-500 hover:underline">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                                                            <path d="M5.75234 19H16M8.78441 3.31171C8.78441 3.31171 8.78441 4.94634 10.419 6.58096C12.0537 8.21559 13.6883 8.21559 13.6883 8.21559M2.31963 15.9881L5.75234 15.4977C6.2475 15.4269 6.70636 15.1975 7.06004 14.8438L15.3229 6.58096C16.2257 5.67818 16.2257 4.21449 15.3229 3.31171L13.6883 1.67708C12.7855 0.774305 11.3218 0.774305 10.419 1.67708L2.15616 9.93996C1.80248 10.2936 1.57305 10.7525 1.50231 11.2477L1.01193 14.6804C0.902951 15.4432 1.5568 16.097 2.31963 15.9881Z" stroke="#28303F" stroke-width="1.5" stroke-linecap="round"/>
                                                        </svg>
                                                        </button>
                            <form action="{{ route('product.delete', $prod->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this prod?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22" fill="none">
                                        <path d="M3 7V17C3 19.2091 4.79086 21 7 21H13C15.2091 21 17 19.2091 17 17V7M12 10V16M8 10L8 16M14 4L12.5937 1.8906C12.2228 1.3342 11.5983 1 10.9296 1H9.07037C8.40166 1 7.7772 1.3342 7.40627 1.8906L6 4M14 4H6M14 4H19M6 4H1" stroke="#28303F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
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
        function openModal(id, name, price,price_visible, people_id,image=null) {
            console.log(`${id} ${name} ${price} ${people_id} ${image}`);
            
            document.getElementById('editModal').classList.remove('hidden');
            var url='/update-product/' + id;
            var path = '../public/';
            document.getElementById('editForm').action = url;
            document.getElementById('name').value = name;
            document.getElementById('price').value = price;
            document.getElementById('edit_price_visible').checked =true ? price_visible==1:false ;
            document.getElementById('editPeopleId').value = people_id;
            document.getElementById('editImageView').src = `${path}/${image}`;
            console.log(image);   
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('editModal').classList.add('hidden');
        });
    </script>

</div>
@endsection