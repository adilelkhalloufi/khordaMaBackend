<?php

namespace App\Actions\User;

use App\Mail\CodeVerification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CreateUser
{
    public function execute(array $input): User
    {
        return DB::transaction(function () use ($input) {

            $user = User::create(
                [
                    User::COL_FIRST_NAME => $input[User::COL_FIRST_NAME],
                    User::COL_LAST_NAME => $input[User::COL_LAST_NAME],
                    User::COL_EMAIL => $input[User::COL_EMAIL],
                    User::COL_PASSWORD => bcrypt($input[User::COL_PASSWORD]),
                ]
            );

            Mail::to($user->email)->send(new CodeVerification($user));

            return $user;

        });
    }
}
