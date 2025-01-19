<?php

namespace App\enum;

use Filament\Support\Contracts\HasLabel;

enum ProductStatue: int implements HasLabel
{

    case Inspection = 1;
    case ShowDetail = 2;
    case Close = 3;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Inspection => 'Inspection',
            self::ShowDetail => 'Show Detail',
            self::Close => 'Close',
        };
    }
}
