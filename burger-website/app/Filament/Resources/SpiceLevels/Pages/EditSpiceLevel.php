<?php

namespace App\Filament\Resources\SpiceLevels\Pages;

use App\Filament\Resources\SpiceLevels\SpiceLevelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpiceLevel extends EditRecord
{
    protected static string $resource = SpiceLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
