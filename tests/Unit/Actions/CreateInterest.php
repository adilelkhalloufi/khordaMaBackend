
<?php

use App\Actions\Product\CreateInterest;
use App\Models\Categorie;
use App\Models\Interest;
use App\Models\User;

it('creates a new interset', function (): void {

    $user = User::factory()->create();
    $category = Categorie::factory()->create();


    $createInterest = new CreateInterest();

    $interest = $createInterest->execute([
        Interest::COL_USER_ID => $user->id,
        Interest::COL_CATEGORY_ID => $category->id,
    ]);

    $this->assertInstanceOf(Interest::class, $interest);
});
