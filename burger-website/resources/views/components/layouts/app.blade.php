<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Kebab MAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>
    @livewireStyles
</head>
<body class="font-inter bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-xl">M</div>
                <div>
                    <h1 class="font-poppins font-bold text-lg">Burger Kebab</h1>
                    <p class="text-orange-500 font-bold text-xs">MAN</p>
                </div>
            </a>
            <div class="flex gap-4 text-sm font-medium">
                <a href="/" class="text-orange-500">Menu</a>
                <livewire:cart-counter />
            </div>
        </div>
    </header>

    <!-- Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6 text-sm mt-12">
        &copy; 2026 Burger Kebab MAN. Mantap • Authentic • Nikmat.
    </footer>

    @livewireScripts
</body>
</html>