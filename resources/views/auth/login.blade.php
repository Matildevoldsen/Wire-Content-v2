<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4"/>

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ $value }}
        </div>
        @endsession

        <x-mary-form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                         autofocus autocomplete="username"/>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                         autocomplete="current-password"/>
            </div>

            <div class="flex items-center justify-between mt-4">
                <label class="flex items-center" for="remember_me">
                    <x-checkbox id="remember_me" name="remember"/>
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember Me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex mt-4">
                <x-slot:actions>
                    <x-mary-button type="submit" class="w-full btn-primary">
                        {{ __('Log in') }}
                    </x-mary-button>
                </x-slot:actions>
            </div>
        </x-mary-form>

        <div class="relative mt-4">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t dark:border-gray-700 border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm font-medium leading-6">
                <span class="bg-white px-6 dark:bg-gray-800 dark:text-gray-100 text-gray-900">Or continue with</span>
            </div>
        </div>
        <div class="flex">
            <a class="w-1/2" href="{{ route('auth.redirect', 'twitter') }}">
                <x-mary-button label="Twitter" icon="fab.twitter" class="btn-ghost w-full"/>
            </a>
            <a class="w-1/2">
                <x-mary-button label="Github" icon="fab.github" class="btn-ghost w-full"/>
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>
