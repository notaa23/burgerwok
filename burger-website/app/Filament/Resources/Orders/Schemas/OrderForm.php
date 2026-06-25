<?php
// FILE: app/Filament/Resources/Orders/Schemas/OrderForm.php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pesanan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('order_number')
                                ->label('Nomor Pesanan')
                                ->required()
                                ->disabled(),
                            TextInput::make('customer_name')
                                ->label('Nama Pelanggan')
                                ->required(),
                            TextInput::make('customer_phone')
                                ->label('No. WhatsApp')
                                ->tel()
                                ->required(),
                            Select::make('payment_method')
                                ->label('Metode Bayar')
                                ->options([
                                    'qris' => 'QRIS',
                                    'transfer' => 'Transfer Bank',
                                    'cod' => 'COD (Bayar di Tempat)',
                                ])
                                ->required(),
                        ]),
                    ]),

                Section::make('Status')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('order_status')
                                ->label('Status Pesanan')
                                ->options([
                                    'pending' => '⏳ Pending',
                                    'processing' => '👨‍🍳 Processing',
                                    'ready' => '✅ Ready',
                                    'completed' => '🎉 Completed',
                                    'cancelled' => '❌ Cancelled',
                                ])
                                ->default('pending')
                                ->required(),
                            Select::make('payment_status')
                                ->label('Status Pembayaran')
                                ->options([
                                    'pending' => '⏳ Pending',
                                    'waiting_confirmation' => '🔍 Menunggu Konfirmasi',
                                    'confirmed' => '✅ Dikonfirmasi',
                                ])
                                ->default('pending')
                                ->required(),
                        ]),
                    ]),

                Section::make('Pembayaran')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('subtotal')
                                ->label('Subtotal')
                                ->required()
                                ->numeric()
                                ->prefix('Rp'),
                            TextInput::make('total')
                                ->label('Total')
                                ->required()
                                ->numeric()
                                ->prefix('Rp'),
                        ]),
                        TextInput::make('payment_proof')
                            ->label('Bukti Pembayaran (path)')
                            ->default(null)
                            ->helperText('Path file bukti pembayaran yang diupload pelanggan.'),
                    ]),

                Section::make('Catatan')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Catatan Pesanan')
                            ->default(null)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
