{{-- FILE: resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Burger Kebab MAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .float-animation { animation: float 3s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <div class="float-animation text-9xl mb-6">🍔</div>
        <h1 class="text-5xl font-poppins font-bold text-gray-800 mb-3">404</h1>
        <p class="text-xl font-poppins font-semibold text-gray-600 mb-2">Halaman Habis Dimakan!</p>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">
            Ups, halaman yang kamu cari tidak ditemukan. Mungkin sudah habis dimakan pelanggan lain 😄
        </p>
        <a href="/"
           class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-8 py-3.5 rounded-2xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-[0.98]">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Kembali ke Menu
        </a>
    </div>
</body>
</html>
