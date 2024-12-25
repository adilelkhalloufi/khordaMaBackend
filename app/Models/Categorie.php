<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Categorie extends Model
{    
    use HasTranslations;
    public $translatable = ['code'];
    
    public const TABLE_NAME = 'categories';

    public const COL_ID = 'id';
    public const COL_CODE = 'code';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    public function translations() : HasMany
    {
        return $this->hasMany(CategoryTranslations::class);
    }
    
    public function translation($lang)
    {
        return $this->translations()->where('language_code', $lang)->first();
    }
}
