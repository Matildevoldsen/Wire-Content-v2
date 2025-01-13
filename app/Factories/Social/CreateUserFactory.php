<?php

declare(strict_types=1);

namespace App\Factories\Social;

use Exception;
use App\Actions\Social\CreateXUser;

final class CreateUserFactory
{
    /**
     * @throws Exception
     */
    public function forService(string $service): CreateXUser
    {
        return match ($service) {
            'twitter' => new CreateXUser,
            default => throw new Exception('Unsupported service')
        };
    }
}
