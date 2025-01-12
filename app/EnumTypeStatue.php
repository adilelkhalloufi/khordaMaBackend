<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum EnumTypeStatue: int implements HasLabel
{

    case Inspection = 1;
    case ShowDetail = 2;



    public function getLabel(): ?string
    {
        // return $this->name;

        return match ($this) {
            self::Inspection => 'Inspection',
            self::ShowDetail => 'Show details',
        };
    }
}
