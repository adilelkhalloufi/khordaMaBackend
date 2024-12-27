<?php

namespace App\Filament\Resources\StatisiticResource\Pages;

use App\Filament\Resources\StatisiticResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatisitic extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = StatisiticResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
