<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

final class AuthRedirectController extends Controller
{
    public function __invoke(string $service)
    {
        return Socialite::driver($service)->redirect();
    }
}
