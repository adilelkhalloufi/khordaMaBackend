<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Unite extends Model
{
    use HasTranslations, HasFactory;

    public $translatable = [self::COL_NAME];
}
