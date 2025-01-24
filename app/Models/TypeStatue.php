<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statue extends Model
{
    public const TABLE_NAME = 'type_statues';

    public const COL_ID = 'id';

    public const COL_NAME = 'name';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';

    //

    public function products()
    {
        return $this->hasMany(Product::class, 'type_statue_id', 'id');
    }
}
