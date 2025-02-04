<?php

namespace App\Actions\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CreateUser
{
    public function execute(array $input): Order
    {
        return DB::transaction(function () {

            $order = Order::create(
                [

                ]
            );

            return $order;
        });
    }
}
