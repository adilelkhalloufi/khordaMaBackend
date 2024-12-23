<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTranslations extends Model
{   
    
    public const TABLE_NAME = 'category_translations';

    public const COL_ID = 'id';
    public const COL_CATEGORY_ID = 'category_id';
    public const COL_LOCALE = 'locale';
    public const COL_NAME = 'name';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    public function category() : BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}
