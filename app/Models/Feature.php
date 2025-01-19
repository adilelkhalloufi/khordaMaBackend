<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public const TABLE_NAME = 'features';

    public const COL_ID = 'id';

    public const COL_NAME = 'name';

    public const COL_DESCRIPTION = 'description';

    public const COL_ICON = 'icon';

    public const COL_COLOR = 'color';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';
}
