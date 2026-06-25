<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
\Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$order = \App\Models\Order::find(9);

$params = [
    'transaction_details' => [
        'order_id' => $order->order_number,
        'gross_amount' => $order->total,
    ],
    'customer_details' => [
        'first_name' => $order->customer_name,
        'phone' => $order->customer_phone,
    ],
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo "SUCCESS: " . $snapToken . "\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
