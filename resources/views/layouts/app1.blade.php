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
<body class="bg-gray-700 flex flex-col items-center justify-center">
    <div class="container mx-auto min-h-[100vh] flex flex-row items-center justify-center">
        @yield('content')
    </div>
</body>
</html>