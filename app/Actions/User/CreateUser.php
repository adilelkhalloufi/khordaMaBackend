<?php

namespace App\Actions\User;

use App\Enum\EnumTypeStatue;
use App\enum\ProfilStatus;
use App\Mail\CodeVerification;
use App\Models\Profil;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CreateUser
{
    public function execute(array $input, CreateProfile $createProfile): User
    {
        return DB::transaction(function () use ($input, $createProfile) {

            $user = User::create(
                [
                    User::COL_FIRST_NAME => $input[User::COL_FIRST_NAME],
                    User::COL_LAST_NAME => $input[User::COL_LAST_NAME],
                    User::COL_EMAIL => $input[User::COL_EMAIL],
                    User::COL_PHONE => $input[User::COL_PHONE],
                    User::COL_CITY_ID => $input[User::COL_CITY_ID],
                    User::COL_ADDRESS => $input[User::COL_ADDRESS],
                    User::COL_PASSWORD => bcrypt($input[User::COL_PASSWORD]),
                    User::COL_ROLE =>  $input[User::COL_ROLE],
                    User::COL_STATUS => ProfilStatus::PENDING,
                    User::COL_SPECIALITIE_ID => $input[User::COL_SPECIALITIE_ID],
                ]
            );
            // test if input has company_name we gone create profil
            if (isset($input[Profil::COL_COMPANY_NAME])) {
                $profil = $createProfile->execute($input);
            }
            Mail::to($user->email)->send(new CodeVerification($user));

            return $user;
        });
    }
}
