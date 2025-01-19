<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public const TABLE_NAME = 'partners';

    public const COL_ID = 'id';

    public const COL_NAME = 'name';

    public const COL_LOGO = 'logo';

    public const COL_DESCRIPTION = 'description';

    public const COL_URL = 'url';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';
}
