<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{ 

   public const TABLE_NAME = 'users';

    public const COL_ID = 'id';
    public const COL_FIRST_NAME = 'first_name';
    public const COL_LAST_NAME = 'last_name';
    public const COL_EMAIL = 'email';
    public const COL_PHONE = 'phone';
    public const COL_ADDRESS = 'address';
    public const COL_CITY_ID = 'city_id';
    public const COL_ROLE = 'role';
    public const COL_STATUS = 'status';
    public const COL_SPECIALITIE_ID = 'specialitie_id';
    public const COL_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const COL_CODE_VERIFY = 'code_verify';
    public const COL_PASSWORD = 'password';
    public const COL_REMEMBER_TOKEN = 'remember_token';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function favoriteProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favorites', 'user_id', 'product_id');
    }
    public function bidproducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'bids','user_id', 'product_id');
    }

    
    public function specialitie(): BelongsTo
    {
        return $this->belongsTo(Specialitie::class, 'specialitie_id', 'id');
    }
 
    
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->HasMany(Order::class, 'user_id', 'id');
    }




    public function profil(): BelongsTo
    {
        return $this->BelongsTo(Profil::class, 'user_id', 'id');
    }

    // function to send code verfecation

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
