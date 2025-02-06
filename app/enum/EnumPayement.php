<?php

namespace App\enum;

use Filament\Support\Contracts\HasLabel;

enum EnumPayement: int implements HasLabel
{
    // 1:cash;2:credit card;3:paypal;4:other
    case Cash = 1;
    case CreditCard = 2;
    case Paypal = 3;
    case Other = 4;
    
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Cash => 'Cash',
            self::CreditCard => 'Credit Card',
            self::Paypal => 'Paypal',
            self::Other => 'Other',
        };
    }

 
}
