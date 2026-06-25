<?php

namespace App\Filament\Resources\SpiceLevels\Pages;

use App\Filament\Resources\SpiceLevels\SpiceLevelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpiceLevels extends ListRecords
{
    protected static string $resource = SpiceLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
