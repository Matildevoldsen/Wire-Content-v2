<?php

declare(strict_types=1);

namespace App\Actions\Social;

use App\Models\User;
use App\Actions\Social\Contracts\CreatesUser;

final class CreateXUser implements CreatesUser
{
    public function create($user): User
    {
        return User::firstOrCreate([
            'x_id' => $user->getId(),
        ], [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'profile_photo_path' => $user->getAvatar(),
        ]);
    }
}
