<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasTranslations;
    //  public $translatable = [self::COL_NAME, self::COL_DESCRIPTION];
}
