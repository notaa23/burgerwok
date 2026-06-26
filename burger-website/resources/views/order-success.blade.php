{{-- FILE: resources/views/order-success.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Burger Kebab MAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800;900&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }

        @keyframes checkmark {
            0% { transform: scale(0) rotate(-45deg); opacity: 0; }
            50% { transform: scale(1.2) rotate(0deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(40px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        .check-icon { animation: checkmark 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .receipt-card { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        /* Zigzag receipt border */
        .receipt-bottom {
            background-image: radial-gradient(circle at 10px 0, transparent 10px, white 11px);
            background-size: 20px 20px;
            background-repeat: repeat-x;
            height: 20px;
            width: 100%;
            margin-top: -10px;
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-sm receipt-card opacity-0 relative z-10">
        {{-- Receipt Top --}}
        <div class="bg-white rounded-t-3xl pt-10 pb-6 px-8 shadow-[0_20px_40px_rgba(0,0,0,0.08)] relative overflow-hidden">
            
            {{-- Success Icon --}}
            <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-500/30">
                <svg class="check-icon w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-2xl font-poppins font-black text-slate-800 tracking-tight">Pesanan Diterima!</h1>
                <p class="text-slate-500 text-sm mt-1">Terima kasih telah memesan di Burger Kebab MAN.</p>
            </div>

            {{-- Divider --}}
            <div class="border-t-2 border-dashed border-slate-200 my-6 relative">
                <div class="absolute -left-10 -top-3 w-6 h-6 bg-slate-100 rounded-full"></div>
                <div class="absolute -right-10 -top-3 w-6 h-6 bg-slate-100 rounded-full"></div>
            </div>

            {{-- Order Details --}}
            <div class="text-center mb-8">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-[0.2em] mb-2">Nomor Pesanan</p>
                <div class="bg-slate-50 py-3 rounded-2xl border border-slate-100">
                    <p class="text-3xl font-poppins font-black text-orange-500 tracking-wider">{{ $orderNumber }}</p>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col gap-3">
                <a href="/payment/{{ $orderNumber }}"
                   class="flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-orange-500/25 active:scale-[0.98]">
                    💳 Lanjut Pembayaran
                </a>
                <a href="/order-status/{{ $orderNumber }}"
                   class="flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-6 py-4 rounded-2xl font-bold transition-all shadow-md active:scale-[0.98]">
                    📋 Cek Status
                </a>
                <a href="/"
                   class="flex items-center justify-center gap-2 text-slate-500 hover:text-slate-800 px-6 py-3 font-semibold transition-colors mt-2">
                    🏠 Kembali ke Beranda
                </a>
            </div>
        </div>
        {{-- Receipt Bottom Zigzag --}}
        <div class="receipt-bottom shadow-[0_20px_40px_rgba(0,0,0,0.08)]"></div>
    </div>
    </div>

    <script>
        // Auto-scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    </script>
</body>
</html>