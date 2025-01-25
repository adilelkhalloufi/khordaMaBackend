
<?php

use App\Actions\Product\CreateProduct;
use App\Models\Product;

it('creates a new product', function () {


    $createProduct = new CreateProduct();

    $product = $createProduct->execute([
        Product::COL_NAME => 'product',
        Product::COL_DESCRIPTION => 'description',
        Product::COL_PRICE => 100,
        Product::COL_CATEGORIE_ID => 1,
        Product::COL_USER_ID => 1,
        Product::COL_STATUS => 1,
        Product::COL_IMAGE => 'image',
        Product::COL_QUANTITY => 1,
        Product::COL_UNITE_ID => 1,
        Product::COL_AVAILABILITY_STATUS => 1,
        Product::COL_AUCTION => 1,
        Product::COL_DATE_END_AUCTION => '2021-10-10',
        Product::COL_CONDITIONS_DOCUMENT => 'conditions_document',
        Product::COL_CONDITIONS_DOCUMENT_PRICE => 1,
        Product::COL_SHOW_COMPANY => 1,

    ]);

    $this->assertInstanceOf(Product::class, $product);
});
