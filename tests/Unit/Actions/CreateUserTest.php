
<?php

use App\Actions\User\CreateUser;
use App\Models\Categorie;
use App\Models\Profil;
use App\Models\Specialitie;
use App\Models\User;

it('creates a new user with role and intrests', function (): void {

    $createUserAction = new CreateUser();

    $categories = Categorie::factory()->count(100)->create();
    $spiecaltie = Specialitie::factory()->create();
    $user = $createUserAction->execute([

        User::COL_FIRST_NAME => 'John',
        User::COL_LAST_NAME => 'Doe',
        User::COL_EMAIL => 'aaaa@dd.com',
        User::COL_PHONE => '123456789',
        User::COL_PASSWORD => 'password',
        User::COL_ROLE => 3,
        User::COL_CITY_ID => 1,
        User::COL_ADDRESS => 'address',
        User::COL_SPECIALITIE_ID => $spiecaltie->id,
        'interests' => $categories->pluck('id')->toArray(),
        Profil::COL_COMPANY_NAME => 'Company name',

    ]);

    $this->assertInstanceOf(User::class, $user);

    // test if this user has interests
    $this->assertNotEmpty($user->interests);
    // test has profil
    $this->assertNotEmpty($user->profil);
});
