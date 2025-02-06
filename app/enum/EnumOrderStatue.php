<?php

namespace App\enum;

use Filament\Support\Contracts\HasLabel;

enum EnumOrderStatue: int implements HasLabel
{
    // 1:active;2:inactive;3:pending;4:deleted

    case Active = 1;
    case Inactive = 2;
    case Pending = 3;
    case Deleted = 4;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Pending => 'Pending',
            self::Deleted => 'Deleted',
        };
    }
 
}
