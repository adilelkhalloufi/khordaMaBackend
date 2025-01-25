<?php

namespace App\Filament\Resources\SpecialitieResource\Pages;

use App\Filament\Resources\SpecialitieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecialitie extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = SpecialitieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
