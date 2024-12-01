<?php

namespace App\Http\Controllers;

use App\Factories\Social\CreateUserFactory;
use Filament\Events\Auth\Registered;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthCallbackController extends Controller
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
