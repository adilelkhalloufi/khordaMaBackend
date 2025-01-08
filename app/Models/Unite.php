<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Unite extends Model
{

    public const TABLE_NAME = 'unites';

    public const COL_ID = 'id';
    public const COL_NAME = 'name';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';
    public $fillable = [
        self::COL_ID,
        self::COL_NAME,
        self::COL_CREATED_AT,
        self::COL_UPDATED_AT
    ];


    use HasTranslations;

    // public $translatable = [self::COL_NAME];
    //
}
