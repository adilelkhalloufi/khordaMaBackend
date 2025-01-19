<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Categorie extends Model
{
  use HasTranslations, HasFactory;
  public $translatable = [self::COL_NAME, self::COL_SLUG, self::COL_DESCRIPTION];

  public function family(): BelongsTo
  {
    return $this->belongsTo(Family::class);
  }
}
