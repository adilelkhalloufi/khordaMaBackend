<?php

namespace App\Filament\Resources\StatisiticResource\Pages;

use App\Filament\Resources\StatisiticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatisitic extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = StatisiticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
