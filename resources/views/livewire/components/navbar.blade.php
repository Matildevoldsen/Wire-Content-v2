<div class="navbar bg-base-100">
    <div class="navbar-start">
        <div aria-label="Mobile Menu Button"
             tabindex="0"
             wire:click="toggleDrawer"
             role="button"
             class="lg:hidden btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
        </div>
        <a href="{{ route('home') }}" class="p-2" wire:navigate>
            {{ config('app.name') }}
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            @foreach ($menu->menuItems as $item)
                <li>
                    <a href="{{ $item->url }}" wire:navigate>
                        @if ($item->icon)
                            <x-mary-icon name="{{ $item->icon }}" />
                        @endif
                        {{ $item->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="navbar-end space-x-2">
        @guest
            <a href="{{ route('login') }}" wire:navigate class="btn btn-primary">
                Login
            </a>

            <a href="{{ route('register') }}" wire:navigate class="btn btn-secondary">
                Register
            </a>
        @endguest
        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img
                            alt="{{ auth()->user()->name }} profile picture"
                            src="{{ auth()->user()->profile_photo_url }}"/>
                    </div>
                </div>
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    @foreach ($dropdown->menuItems as $item)
                        <li>
                            <a href="{{ $item->url }}" {{ $item->use_navigate ? 'wire:navigate' : '' }}>
                                {{ $item->title }}
                            </a>
                        </li>
                    @endforeach

                    <li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}"
                               @click.prevent="$root.submit()">
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>

    <x-mary-drawer wire:model="responsiveMenu" class="w-11/12 lg:w-1/3">
        <x-mary-menu class="p-0 m-0">
            @foreach ($menu->menuItems as $item)
                <x-mary-menu-item title="{{ $item->title }}" link="{{ $item->url }}"
                    icon="{{ $item->icon }}"/>
            @endforeach
        </x-mary-menu>
    </x-mary-drawer>
</div>
