
<?php

use App\Actions\User\CreateUser;
use App\Models\User;

it('creates a new user', function (): void {

    $createUserAction = new CreateUser();

    $user = $createUserAction->execute([
        User::COL_FIRST_NAME => 'John',
        User::COL_LAST_NAME => 'Doe',
        User::COL_EMAIL => 'aaaa@dd.com',
        User::COL_PASSWORD => 'password',
    ]);

    $this->assertInstanceOf(User::class, $user);

});
