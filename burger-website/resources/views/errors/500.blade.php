{{-- FILE: resources/views/errors/500.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | Burger Kebab MAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        .shake-animation { animation: shake 1s ease-in-out infinite; }
        .flicker { animation: flicker 1.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <div class="shake-animation text-9xl mb-6">🔥</div>
        <h1 class="text-5xl font-poppins font-bold text-gray-800 mb-3">500</h1>
        <p class="text-xl font-poppins font-semibold text-gray-600 mb-2 flicker">Dapur Lagi Kebakaran!</p>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">
            Waduh, ada masalah di dapur kami. Tim kami sedang memadamkan api. Coba lagi dalam beberapa saat ya! 🧯
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="/"
               class="inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-8 py-3.5 rounded-2xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-[0.98]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Menu
            </a>
            <button onclick="window.location.reload()"
                    class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-3.5 rounded-2xl font-semibold transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Coba Lagi
            </button>
        </div>
    </div>
</body>
</html>
