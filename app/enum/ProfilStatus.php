<?php

namespace App\enum;

enum ProfilStatus: int
{
    case ACTIF = 1;
    case INACTIF = 2;
    case PENDING = 3;
    case DELETED = 4;

}
