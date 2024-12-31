<?php

namespace App\Filament\Resources\UniteResource\Pages;

use App\Filament\Resources\UniteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnite extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = UniteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
