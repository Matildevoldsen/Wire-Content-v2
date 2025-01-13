<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Filament\Events\Auth\Registered;
use Laravel\Socialite\Facades\Socialite;
use App\Factories\Social\CreateUserFactory;

final class AuthCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $service)
    {
        $user = Socialite::driver($service)->user();

        auth()->login(
            $user = app(CreateUserFactory::class)
                ->forService($service)
                ->create($user)
        );

        if ($user->wasRecentlyCreated) {
            event(new Registered($user));
        }

        return redirect()->route('home');
    }
}
