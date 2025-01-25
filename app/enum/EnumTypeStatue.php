<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum EnumTypeStatue: int implements HasLabel
{
    public function getLabel(): ?string
    {
        // return $this->name;

        return match ($this) {
            self::Inspection => 'Inspection',
            self::ShowDetail => 'Show details',
        };
    }
    case Inspection = 1;
    case ShowDetail = 2;
}
