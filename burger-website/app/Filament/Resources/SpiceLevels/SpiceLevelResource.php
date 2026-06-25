<?php

namespace App\Filament\Resources\SpiceLevels;

use App\Filament\Resources\SpiceLevels\Pages\CreateSpiceLevel;
use App\Filament\Resources\SpiceLevels\Pages\EditSpiceLevel;
use App\Filament\Resources\SpiceLevels\Pages\ListSpiceLevels;
use App\Filament\Resources\SpiceLevels\Schemas\SpiceLevelForm;
use App\Filament\Resources\SpiceLevels\Tables\SpiceLevelsTable;
use App\Models\SpiceLevel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SpiceLevelResource extends Resource
{
    protected static ?string $model = SpiceLevel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SpiceLevelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpiceLevelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSpiceLevels::route('/'),
            'create' => CreateSpiceLevel::route('/create'),
            'edit' => EditSpiceLevel::route('/{record}/edit'),
        ];
    }
}
