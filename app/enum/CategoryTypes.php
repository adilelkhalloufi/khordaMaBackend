<?php

namespace App\enum;

use Filament\Support\Contracts\HasLabel;

enum CategoryTypes: int implements HasLabel
{
    case Scrap = 1;
    case Stagnant = 2;
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Scrap => 'Scrap',
            self::Stagnant => 'Stagnant',
        };
    }
}
