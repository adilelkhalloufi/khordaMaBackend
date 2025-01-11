<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

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

    use HasTranslations;
    //  public $translatable = [self::COL_NAME, self::COL_DESCRIPTION];
}
