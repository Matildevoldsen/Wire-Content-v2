<?php

declare(strict_types=1);

namespace App\Actions\Social\Contracts;

use App\Models\User;

interface CreatesUser
{
    public function create($user): User;
}
