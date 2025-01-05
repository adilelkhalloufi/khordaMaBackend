<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Products extends Model
{
    public function images(): BelongsTo
    {
        return $this->belongsTo(Attachement::class);
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachement::class, Attachement::COL_MODEL);
    }
}
