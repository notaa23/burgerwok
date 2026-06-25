<?php

namespace App\Filament\Resources\SpiceLevels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SpiceLevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->default(null),
                TextInput::make('level')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
