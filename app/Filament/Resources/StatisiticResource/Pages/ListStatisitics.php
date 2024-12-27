<?php

namespace App\Filament\Resources\StatisiticResource\Pages;

use App\Filament\Resources\StatisiticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatisitics extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = StatisiticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
