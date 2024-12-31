<?php

namespace App\Filament\Resources\UniteResource\Pages;

use App\Filament\Resources\UniteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUnite extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = UniteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
