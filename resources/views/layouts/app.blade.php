<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
     <!-- Tailwind CSS CDN -->
     <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center">
    <!-- Header -->
    <header class="bg-white text-white p-4 min-x-[320px] max-w-[1920px] w-full
                   fixed top-0 left-0
                   flex flex-row justify-between items-center 
                   shadow-md">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="https://via.placeholder.com/40" alt="Logo" class="w-10 h-10">
            <span class="text-2xl font-semibold color-grey-300">Logo</span>
        </div>

        <!-- Account Section -->
        <div class="relative flex flex-row items-center justify-between" x-data="{ open: false }">
            <!-- Account Image -->
            <img src="https://via.placeholder.com/40" alt="Account"
                class="w-10 h-10 rounded-full border-2 border-white cursor-pointer">
                
            <!-- LogOut button -->
            <a href="{{route('logout')}}" class="bg-white text-gray-700 rounded shadow-lg overflow-hidden">
                <!-- LogOut Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5A2.25 2.25 0 003.75 5.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15m3.75-3H9m6-3l3 3m0 0l-3 3" />
                </svg>
            </a>
        </div>
    </header>
    <div class="container mx-auto min-h-[100vh] flex flex-row items-center justify-center">
        @yield('content')
    </div>
</body>
</html>