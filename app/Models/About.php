<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{

    use HasTranslations;
    public $translatable = [self::COL_TITLE,self::COL_DESCRIPTION];
    
    public const TABLE_NAME = 'abouts';

    public const COL_ID = 'id';
    public const COL_TITLE = 'title';
    public const COL_DESCRIPTION = 'description';
    public const COL_IMAGE = 'image';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';


     
     

}
