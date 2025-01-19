<?php

namespace App\enum;

enum UserRole: int
{
    case ADMIN = 1;
    case SELLER = 2;
    case VENDER = 3;
    case USER = 4;
}
