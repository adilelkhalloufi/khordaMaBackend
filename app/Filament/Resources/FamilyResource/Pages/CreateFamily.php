<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Filament\Resources\FamilyResource;
use Filament\Actions;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Pages\CreateRecord;

class CreateFamily extends CreateRecord
{
    use Translatable;

    protected static string $resource = FamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
