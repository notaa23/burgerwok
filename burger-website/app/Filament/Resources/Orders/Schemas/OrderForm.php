<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                    ->required(),
                TextInput::make('customer_name')
                    ->required(),
                TextInput::make('customer_phone')
                    ->tel()
                    ->required(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('total')
                    ->required()
                    ->numeric(),
                Select::make('payment_method')
                    ->options(['qris' => 'Qris', 'transfer' => 'Transfer', 'cod' => 'Cod'])
                    ->required(),
                Select::make('payment_status')
                    ->options([
            'pending' => 'Pending',
            'waiting_confirmation' => 'Waiting confirmation',
            'confirmed' => 'Confirmed',
        ])
                    ->default('pending')
                    ->required(),
                Select::make('order_status')
                    ->options([
            'pending' => 'Pending',
            'processing' => 'Processing',
            'ready' => 'Ready',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ])
                    ->default('pending')
                    ->required(),
                TextInput::make('payment_proof')
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
