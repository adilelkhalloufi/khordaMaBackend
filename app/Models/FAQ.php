<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FAQ extends Model
{    public const TABLE_NAME = 'f_a_q_s';

    public const COL_ID = 'id';
    public const COL_QUESTION = 'question';
    public const COL_ANSWER = 'answer';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    use HasTranslations;
    public $translatable = [];
}
