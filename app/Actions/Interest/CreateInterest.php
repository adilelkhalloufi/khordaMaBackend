<?php

namespace App\Actions\Product;

use App\Models\Interest;
use Illuminate\Support\Facades\DB;

class CreateInterest
{
    public function execute(array $input): Interest
    {
        return DB::transaction(function () use ($input) {

            $interest = Interest::create(
                [
                    Interest::COL_USER_ID => $input[Interest::COL_USER_ID],
                    Interest::COL_CATEGORY_ID => $input[Interest::COL_CATEGORY_ID],
                ]
            );

            return $interest;
        });
    }
}
