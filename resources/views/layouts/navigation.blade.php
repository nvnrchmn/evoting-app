<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo"
                            class="mx-auto block w-12 h-12 sm:w-9 sm:h-9">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                @if(Auth::check())
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        @if(Auth::user()->role === 'voter')
                            <x-nav-link :href="route('voter.elections.index')"
                                :active="request()->routeIs('voter.elections.index')">
                                {{ __('Voting Saya') }}
                            </x-nav-link>
                        @endif

                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.groups.index')" :active="request()->routeIs('admin.groups.*')">
                                {{ __('Groups') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.candidates.index')"
                                :active="request()->routeIs('admin.candidates.*')">
                                {{ __('Candidates') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.elections.index')"
                                :active="request()->routeIs('admin.elections.*')">
                                {{ __('Elections') }}
                            </x-nav-link>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if(Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Dashboard -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @auth
                @if(Auth::user()->role === 'voter')
                    <!-- Voter Menu -->
                    <x-responsive-nav-link :href="route('voter.elections.index')"
                        :active="request()->routeIs('voter.elections.index')">
                        {{ __('Voting Saya') }}
                    </x-responsive-nav-link>
                @endif

                @if(Auth::user()->role === 'admin')
                    <!-- Admin Menu -->
                    <x-responsive-nav-link :href="route('admin.groups.index')" :active="request()->routeIs('admin.groups.*')">
                        {{ __('Groups') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.candidates.index')"
                        :active="request()->routeIs('admin.candidates.*')">
                        {{ __('Candidates') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.elections.index')"
                        :active="request()->routeIs('admin.elections.*')">
                        {{ __('Elections') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Profile -->
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @endauth
        </div>
    </div>

</nav>