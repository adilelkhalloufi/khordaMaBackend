<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Filament\Resources\FamilyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFamilies extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
