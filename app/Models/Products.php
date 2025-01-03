<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    //



    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function images() : BelongsTo 
    {
        return $this->belongsTo(Attachement::class);
    }
}
