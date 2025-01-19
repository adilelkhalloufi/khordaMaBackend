<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Family extends Model
{

    use HasTranslations;    // public $translatable = [self::COL_NAME];
    public const TABLE_NAME = 'families';

    public const COL_ID = 'id';

    public const COL_NAME = 'name';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';
}
