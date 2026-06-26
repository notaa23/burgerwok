<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->weight('bold')
                    ->color('primary'),
                TextColumn::make('customer_name')
                    ->searchable()
                    ->description(fn ($record) => $record->customer_phone . ' • ' . $record->orderItems->map(fn($item) => $item->quantity . 'x ' . ($item->menu->name ?? 'Menu'))->implode(', ')),
                TextColumn::make('subtotal')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('total')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('payment_method')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'waiting_confirmation' => 'info',
                        'confirmed' => 'success',
                        'failed', 'expired', 'canceled' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('order_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                ImageColumn::make('payment_proof')
                    ->disk('public')
                    ->label('Bukti Bayar')
                    ->circular(false)
                    ->width(60)
                    ->height(60)
                    ->url(fn ($record) => $record->payment_proof ? asset('storage/' . $record->payment_proof) : null)
                    ->openUrlInNewTab()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('confirmPayment')
                    ->label('✅ Konfirmasi Lunas')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn ($record) => $record->payment_status === 'waiting_confirmation')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pembayaran')
                    ->modalDescription(fn ($record) => 'Konfirmasi bahwa pembayaran pesanan ' . $record->order_number . ' dari ' . $record->customer_name . ' sudah lunas?')
                    ->action(function ($record) {
                        $record->update([
                            'payment_status' => 'confirmed',
                        ]);

                        Notification::make()
                            ->title('Pembayaran Dikonfirmasi! ✅')
                            ->body('Pesanan ' . $record->order_number . ' dari ' . $record->customer_name . ' telah lunas dan siap dimasak.')
                            ->success()
                            ->sendToDatabase(User::all());

                        Notification::make()
                            ->title('Pesanan dikonfirmasi lunas!')
                            ->body('Pesanan ' . $record->order_number . ' sekarang siap untuk dimasak.')
                            ->success()
                            ->send();
                    }),
                Action::make('processOrder')
                    ->label('🔥 Masak Pesanan')
                    ->color('warning')
                    ->icon('heroicon-o-fire')
                    ->visible(fn ($record) => $record->order_status === 'pending' && (in_array($record->payment_status, ['confirmed', 'paid']) || $record->payment_method === 'cod'))
                    ->action(function ($record) {
                        $record->update(['order_status' => 'processing']);
                        Notification::make()->title('Pesanan diproses!')->success()->send();
                    }),
                Action::make('completeOrder')
                    ->label('✅ Pesanan Selesai')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn ($record) => $record->order_status === 'processing')
                    ->action(function ($record) {
                        $record->update(['order_status' => 'completed']);
                        Notification::make()->title('Pesanan selesai dimasak!')->success()->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('5s');
    }
}
