<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public const TABLE_NAME = 'families';

    public const COL_ID = 'id';

    public const COL_NAME = 'name';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }
}
