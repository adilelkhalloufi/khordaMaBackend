<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Statistic extends Model
{

    use HasTranslations;    // public $translatable = [
    public const TABLE_NAME = 'statistics';

    public const COL_ID = 'id';

    public const COL_TITLE = 'title';

    public const COL_DESCRIPTION = 'description';

    public const COL_ICON = 'icon';

    public const COL_UNITE = 'unite';

    public const COL_TOTAL = 'total';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';
    //     self::COL_TITLE,
    //     self::COL_DESCRIPTION,
    //     self::COL_UNITE

    // ];
}
