<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{

    use HasTranslations;    // public $translatable = [self::COL_NAME, self::COL_DESCRIPTION];
    public const TABLE_NAME = 'partners';

    public const COL_ID = 'id';

    public const COL_NAME = 'name';

    public const COL_LOGO = 'logo';

    public const COL_DESCRIPTION = 'description';

    public const COL_URL = 'url';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';
}
