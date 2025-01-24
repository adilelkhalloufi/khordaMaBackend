
<?php

use App\Models\Bid;
use App\Models\Categorie;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\Unite;
use App\Models\User;




it("to array",function(){
    $user = User::factory()->create()->refresh();
     expect(array_keys($user->toArray()))->tobe([
        User::COL_ID,
        User::COL_FIRST_NAME,
        User::COL_LAST_NAME,
        User::COL_EMAIL,
        User::COL_PHONE,
        User::COL_ADDRESS,
        User::COL_CITY_ID,
        User::COL_ROLE,
        User::COL_STATUS,
        User::COL_EMAIL_VERIFIED_AT,
        User::COL_CODE_VERIFY,
        User::COL_CREATED_AT,
        User::COL_UPDATED_AT,
    ]);
});



it('may have products', function () {

    Categorie::factory()->count(4)->create();
    Unite::factory()->count(4)->create();   
    $user = User::factory()->hasProducts(3)->create();

    expect($user->products)->toHaveCount(3)
        ->each->toBeInstanceOf(Product::class);
});

it('may have favorites', function () {
    
    $products = Product::factory()->count(5)->create();

     $user = User::factory()->create();

     $user->favoriteProducts()->attach($products->take(3)); // Attach 3 products as favorites

    expect($user->favoriteProducts)->toHaveCount(3);

    $favoriteProductIds = $user->favoriteProducts->pluck('id')->toArray();
    expect($favoriteProductIds)->toEqual($products->take(3)->pluck('id')->toArray());
});

it('may have bids', function () {
    $products = Product::factory()->count(5)->create();

    $user = User::factory()->create();

    $user->bidproducts()->attach($products->take(3)); // Attach 3 products as bids

    expect($user->bidproducts)->toHaveCount(3);

});

it('may have orders', function () {
    $user = User::factory()->hasOrders(3)->create();

    expect($user->orders)->toHaveCount(3)
        ->each->toBeInstanceOf(Order::class);
});

it('may have specialities', function () {
    $categories = Categorie::factory()->count(5)->create();

    $user = User::factory()->create();

    $user->specialities()->attach($categories->take(3)); // Attach 3 categories as specialities

    expect($user->specialities)->toHaveCount(3);

    $specialityIds = $user->specialities->pluck('id')->toArray();
    expect($specialityIds)->toEqual($categories->take(3)->pluck('id')->toArray());
});

// it('may have a profil', function () {
//     $user = User::factory()->hasProfil()->create();

//     expect($user->profil)->toBeInstanceOf(Profil::class);
// });


