<?php

namespace App\Actions\Social\Contracts;

use App\Models\User;

interface CreatesUser
{
    public function create($user): User;
}
