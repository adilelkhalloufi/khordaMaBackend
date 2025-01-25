<?php

namespace App\Actions\User;

use App\Models\Profil;
use Illuminate\Support\Facades\DB;

class CreateProfile
{
    public function execute(array $input): Profil
    {
        return DB::transaction(function () use ($input) {

            $profil = Profil::create(
                [
                    Profil::COL_COMPANY_NAME => $input[Profil::COL_COMPANY_NAME],
                ]
            );


            return $profil;
        });
    }
}
