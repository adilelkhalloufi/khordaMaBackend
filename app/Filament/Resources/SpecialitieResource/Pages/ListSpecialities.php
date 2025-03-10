<?php

namespace App\Filament\Resources\SpecialitieResource\Pages;

use App\Filament\Resources\SpecialitieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecialities extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SpecialitieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
