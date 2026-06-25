{{-- FILE: resources/views/order-success.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Burger Kebab MAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }

        @keyframes checkmark {
            0% { transform: scale(0) rotate(-45deg); opacity: 0; }
            50% { transform: scale(1.2) rotate(0deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        @keyframes circleGrow {
            0% { transform: scale(0); }
            60% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes confettiFall {
            0% { transform: translateY(-20px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100px) rotate(720deg); opacity: 0; }
        }

        .check-circle { animation: circleGrow 0.6s ease-out forwards; }
        .check-icon { animation: checkmark 0.5s ease-out 0.3s forwards; opacity: 0; }
        .fade-up-1 { animation: fadeUp 0.5s ease-out 0.6s forwards; opacity: 0; }
        .fade-up-2 { animation: fadeUp 0.5s ease-out 0.8s forwards; opacity: 0; }
        .fade-up-3 { animation: fadeUp 0.5s ease-out 1.0s forwards; opacity: 0; }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen relative overflow-hidden">

    {{-- Confetti particles --}}
    <div class="absolute inset-0 pointer-events-none" id="confetti-container">
        @for($i = 0; $i < 20; $i++)
            @php
                $colors = ['#F97316', '#EAB308', '#22C55E', '#3B82F6', '#EF4444'];
                $color = $colors[array_rand($colors)];
                $left = rand(5, 95);
                $delay = rand(0, 20) / 10;
                $duration = rand(15, 30) / 10;
            @endphp
            <div class="confetti" style="
                left: {{ $left }}%;
                top: -20px;
                background-color: {{ $color }};
                animation: confettiFall {{ $duration }}s ease-in {{ $delay }}s forwards;
            "></div>
        @endfor
    </div>

    <div class="text-center px-4 max-w-md mx-auto relative z-10">
        {{-- Check Animation --}}
        <div class="mb-6">
            <div class="check-circle w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto shadow-lg shadow-green-200">
                <svg class="check-icon w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        {{-- Text --}}
        <h1 class="fade-up-1 text-3xl font-poppins font-bold text-gray-800 mb-2">Pesanan Berhasil!</h1>
        <p class="fade-up-1 text-gray-500 mb-2">Nomor pesanan kamu:</p>
        <p class="fade-up-2 text-3xl font-poppins font-bold text-orange-500 mb-8 tracking-wider">{{ $orderNumber }}</p>

        {{-- Buttons --}}
        <div class="fade-up-3 flex flex-col gap-3 max-w-xs mx-auto">
            <a href="/order-status/{{ $orderNumber }}"
               class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3.5 rounded-2xl font-bold transition-all shadow-md hover:shadow-lg active:scale-[0.98]">
                📦 Cek Status Pesanan
            </a>
            <a href="/payment/{{ $orderNumber }}"
               class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3.5 rounded-2xl font-bold transition-all shadow-md hover:shadow-lg active:scale-[0.98]">
                💳 Bayar Sekarang
            </a>
            <a href="/"
               class="flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3.5 rounded-2xl font-semibold transition-all">
                🏠 Kembali ke Menu
            </a>
        </div>
    </div>

    <script>
        // Auto-scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    </script>
</body>
</html>