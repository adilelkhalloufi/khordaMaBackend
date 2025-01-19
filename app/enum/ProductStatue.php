<?php

namespace App\enum;

use Filament\Support\Contracts\HasLabel;

enum ProductStatue: int implements HasLabel
{
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Inspection => 'Inspection',
            self::ShowDetail => 'Show Detail',
            self::Close => 'Close',
        };
    }
    case Inspection = 1;
    case ShowDetail = 2;
    case Close = 3;
}
