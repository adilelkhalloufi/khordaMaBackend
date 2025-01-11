<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FAQ extends Model
{

    use HasTranslations;
    public $translatable = [self::COL_QUESTION,self::COL_ANSWER];    

    
}
