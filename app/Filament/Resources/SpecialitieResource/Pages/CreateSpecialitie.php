<?php

namespace App\Filament\Resources\SpecialitieResource\Pages;

use App\Filament\Resources\SpecialitieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSpecialitie extends CreateRecord
{
    protected static string $resource = SpecialitieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
