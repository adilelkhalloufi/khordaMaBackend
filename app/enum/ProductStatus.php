<?php

namespace App\enum;

enum ProductStatus: int
{

    case Pending = 1;
    case InProgress = 2;
    case Done = 3;
    case Cancelled = 4;

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::InProgress => 'In Progress',
            self::Done => 'Done',
            self::Cancelled => 'Cancelled',
        };
    }
}
