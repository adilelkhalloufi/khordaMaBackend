<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CreateProduct
{
    public function execute(array $input): Product
    {
        return DB::transaction(function () use ($input) {

            $product = Product::create(
                [
                    Product::COL_NAME => $input[Product::COL_NAME],
                    Product::COL_DESCRIPTION => $input[Product::COL_DESCRIPTION],
                    Product::COL_PRICE => $input[Product::COL_PRICE],
                    Product::COL_CATEGORIE_ID => $input[Product::COL_CATEGORIE_ID],
                    Product::COL_USER_ID => $input[Product::COL_USER_ID],
                    Product::COL_STATUS => $input[Product::COL_STATUS],
                    Product::COL_IMAGE => $input[Product::COL_IMAGE],
                    Product::COL_QUANTITY => $input[Product::COL_QUANTITY],
                    Product::COL_UNITE_ID => $input[Product::COL_UNITE_ID],
                    Product::COL_AVAILABILITY_STATUS => $input[Product::COL_AVAILABILITY_STATUS],
                    Product::COL_AUCTION => $input[Product::COL_AUCTION],
                    Product::COL_DATE_END_AUCTION => $input[Product::COL_DATE_END_AUCTION],
                    Product::COL_CONDITIONS_DOCUMENT => $input[Product::COL_CONDITIONS_DOCUMENT],
                    Product::COL_CONDITIONS_DOCUMENT_PRICE => $input[Product::COL_CONDITIONS_DOCUMENT_PRICE],
                    Product::COL_SHOW_COMPANY => $input[Product::COL_SHOW_COMPANY],

                ]
            );

            return $product;
        });
    }
}
