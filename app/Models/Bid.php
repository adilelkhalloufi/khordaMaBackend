<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public const TABLE_NAME = 'bids';

    public const COL_ID = 'id';

    public const COL_PRICE = 'price';

    public const COL_QUANTITY = 'quantity';

    public const COL_DESCRIPTION = 'description';

    public const COL_STATUS = 'status';

    public const COL_PRODUCT_ID = 'product_id';

    public const COL_USER_ID = 'user_id';

    public const COL_CREATED_AT = 'created_at';

    public const COL_UPDATED_AT = 'updated_at';

    //
}
