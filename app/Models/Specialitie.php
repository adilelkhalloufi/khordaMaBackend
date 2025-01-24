<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialitie extends Model
{ 

use HasFactory;

    public $timestamps = false;

    protected $table = 'specialities';

    protected $fillable = [
        'name',
        'type',
        'created_at',
        'updated_at',
    ];

   public const TABLE_NAME = 'specialities';

    public const COL_ID = 'id';
    public const COL_NAME = 'name';
    public const COL_TYPE = 'type';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    
}
