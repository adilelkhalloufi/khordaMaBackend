<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public const TABLE_NAME = 'blogs';

    public const COL_ID = 'id';

    public const COL_TITLE = 'title';

    public const COL_SLUG = 'slug';

    public const COL_DESCRIPTION = 'description';

    public const COL_IMAGE = 'image';

    public const COL_CATEGORY = 'category';

    public const COL_AUTHOR = 'author';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';
}
