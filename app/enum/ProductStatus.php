<?php

namespace App\enum;

use Filament\Support\Contracts\HasLabel;

enum ProductStatus: int implements HasLabel
{

    case Draft = 1;
    case Reviewing = 2;
    case Published = 3;
    case Rejected = 4;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Reviewing => 'In Progress',
            self::Published => 'Published',
            self::Rejected => 'Rejected',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Reviewing => 'warning',
            self::Published => 'success',
            self::Rejected => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Draft => 'heroicon-m-pencil',
            self::Reviewing => 'heroicon-m-eye',
            self::Published => 'heroicon-m-check',
            self::Rejected => 'heroicon-m-x-mark',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Draft => 'This has not finished being written yet.',
            self::Reviewing => 'This is ready for a staff member to read.',
            self::Published => 'This has been approved by a staff member and is public on the website.',
            self::Rejected => 'A staff member has decided this is not appropriate for the website.',
        };
    }
}
