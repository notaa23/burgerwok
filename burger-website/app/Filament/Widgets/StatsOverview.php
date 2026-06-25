<?php
// FILE: app/Filament/Widgets/StatsOverview.php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();

        // Pesanan hari ini
        $ordersToday = Order::whereDate('created_at', $today)->count();

        // Pendapatan hari ini (dari pesanan completed)
        $revenueToday = Order::whereDate('created_at', $today)
            ->where('order_status', 'completed')
            ->sum('total');

        // Pesanan pending
        $pendingOrders = Order::where('order_status', 'pending')->count();

        // Menu terlaris
        $bestSeller = OrderItem::select('menu_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('menu_id')
            ->orderByDesc('total_qty')
            ->first();

        $bestSellerName = $bestSeller && $bestSeller->menu
            ? $bestSeller->menu->name
            : 'Belum ada';

        return [
            Stat::make('Pesanan Hari Ini', $ordersToday)
                ->description('Total pesanan masuk hari ini')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),

            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($revenueToday, 0, ',', '.'))
                ->description('Dari pesanan selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),

            Stat::make('Pesanan Pending', $pendingOrders)
                ->description('Menunggu diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),

            Stat::make('Menu Terlaris', $bestSellerName)
                ->description('Paling banyak dipesan')
                ->descriptionIcon('heroicon-m-fire')
                ->color('info'),
        ];
    }
}
