<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{    public const TABLE_NAME = 'customers';

    public const COL_ID = 'id';
    public const COL_FIRST_NAME = 'first_name';
    public const COL_LAST_NAME = 'last_name';
    public const COL_EMAIL = 'email';
    public const COL_PHONE_NUMBER = 'phone_number';
    public const COL_ADDRESS = 'address';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    //
}
