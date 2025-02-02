<?php

namespace App\Actions\Profile;

use App\Models\Profil;

class CreateProfile
{
    public function execute(array $input): Profil
    {
        return Profil::create($input);
    }
}
