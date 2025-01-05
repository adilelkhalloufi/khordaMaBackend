<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Products extends Model
{

    public const TABLE_NAME = 'products';

    public const COL_ID = 'id';
    public const COL_NAME = 'name';
    public const COL_DESCRIPTION = 'description';
    public const COL_PRICE = 'price';
    public const COL_CATEGORIE_ID = 'categorie_id';
    public const COL_UNITE_ID = 'unite_id';
    public const COL_STATUE = 'statue';
    public const COL_CONDITIONS_DOCUMENT = 'conditions_document';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

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
