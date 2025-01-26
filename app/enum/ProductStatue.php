<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum ProductStatue: int implements HasLabel
{
    case Inspection = 1;
    case ShowDetail = 2;
    case Close = 3;

    public function getLabel(): string
    {
        return json_encode([
            'ar' => $this->getArabicLabel(),
            'fr' => $this->getFrenchLabel(),
            'en' => $this->getEnglishLabel(),
        ]);
    }

    private function getEnglishLabel(): string
    {
        return match ($this) {
            self::Inspection => 'Inspection',
            self::ShowDetail => 'Show Detail',
            self::Close => 'Close',
        };
    }

    private function getFrenchLabel(): string
    {
        return match ($this) {
            self::Inspection => 'Inspection',
            self::ShowDetail => 'Afficher les détails',
            self::Close => 'Fermer',
        };
    }

    private function getArabicLabel(): string
    {
        return match ($this) {
            self::Inspection => 'فحص',
            self::ShowDetail => 'عرض التفاصيل',
            self::Close => 'إغلاق',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Inspection => 'default',
            self::ShowDetail => 'secondary',
            self::Close => 'destructive',
        };
    }
}
