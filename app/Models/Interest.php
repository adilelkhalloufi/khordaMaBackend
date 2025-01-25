<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{ 

   public const TABLE_NAME = 'interests';

    public const COL_ID = 'id';
    public const COL_USER_ID = 'user_id';
    public const COL_CATEGORY_ID = 'category_id';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    /** @use HasFactory<\Database\Factories\InterestFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
