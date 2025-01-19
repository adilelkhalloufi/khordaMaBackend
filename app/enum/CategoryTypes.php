<?php

namespace App\enum;

use Filament\Support\Contracts\HasLabel;

enum CategoryTypes: int implements HasLabel
{
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Scrap => 'Scrap',
            self::Stagnant => 'Stagnant',
        };
    }
    case Scrap = 1;
    case Stagnant = 2;
}
