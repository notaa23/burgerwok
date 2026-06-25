<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Burger Kebab MAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <p class="text-8xl mb-4">✅</p>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Berhasil!</h1>
        <p class="text-gray-500 mb-2">Nomor pesanan kamu:</p>
        <p class="text-3xl font-bold text-orange-500 mb-6">{{ $orderNumber }}</p>
        
        <div class="flex flex-col gap-3 max-w-xs mx-auto">
            <a href="/order-status/{{ $orderNumber }}" 
               class="block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full font-semibold transition">
                📦 Cek Status Pesanan
            </a>
            <a href="/payment/{{ $orderNumber }}" 
               class="block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full font-semibold transition">
                💳 Bayar Sekarang
            </a>
            <a href="/" 
               class="block bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-full font-semibold transition">
                🏠 Kembali ke Menu
            </a>
        </div>
    </div>
</body>
</html>