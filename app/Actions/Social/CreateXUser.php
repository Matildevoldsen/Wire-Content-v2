<?php

namespace App\Actions\Social;

use App\Actions\Social\Contracts\CreatesUser;
use App\Models\User;

class CreateXUser implements CreatesUser
{
    public function create($user): User
    {
        return User::firstOrCreate([
            'x_id' => $user->getId()
        ], [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'profile_photo_path' => $user->getAvatar(),
        ]);
    }
}
