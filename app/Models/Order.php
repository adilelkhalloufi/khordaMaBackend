<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{ 

   public const TABLE_NAME = 'orders';

    public const COL_ID = 'id';
    public const COL_USER_ID = 'user_id';
    public const COL_PRODUCT_ID = 'product_id';
    public const COL_QUANTITY = 'quantity';
    public const COL_PRICE = 'price';
    public const COL_NOTE = 'note';
    public const COL_ADDRESS = 'address';
    public const COL_PAYMENT = 'payment';
    public const COL_STATUS = 'status';
    public const COL_CREATED_AT = 'created_at';
    public const COL_UPDATED_AT = 'updated_at';

    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
