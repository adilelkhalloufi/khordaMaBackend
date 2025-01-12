<?php

namespace App\Models;

use App\enum\ProductStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    protected $guarded = [];
    public const TABLE_NAME = 'products';

    public const COL_ID = 'id';
    public const COL_NAME = 'name';
    public const COL_DESCRIPTION = 'description';
    public const COL_PRICE = 'price';
    public const COL_QUANTITY = 'quantity';
    public const COL_CATEGORIE_ID = 'categorie_id';
    public const COL_UNITE_ID = 'unite_id';
    public const COL_STATUE = 'statue';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';





    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function Unite(): BelongsTo
    {
        return $this->belongsTo(Unite::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachement::class, 'model');
    }

    protected $casts = [
        'statue' => ProductStatus::class,
    ];
}
