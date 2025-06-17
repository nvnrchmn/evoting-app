<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo"
                            class="mx-auto block w-12 h-12 sm:w-9 sm:h-9">
                    </a>
                </div>

                <!-- Navigation Links -->
                @if(Auth::check())
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        @if(Auth::user()->role === 'voter')
                            {{-- <x-nav-link :href="route('voter.voting.index')" :active="request()->routeIs('voter.voting.*')">
                                {{ __('Voting') }}
                            </x-nav-link> --}}
                            <x-nav-link :href="route('voter.elections.index')"
                                :active="request()->routeIs('voter.elections.index')">
                                {{ __('Voting Saya') }}
                            </x-nav-link>
                            {{-- <x-nav-link>
                                <div x-data="{ open: false }" class="relative items-center px-2 pt-3">
                                    <button @click="open = !open" class="inline-flex items-center px-3 py-2">
                                        voting Saya
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div x-show="open" @click.away="open = false"
                                        class="absolute mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                        <div class="py-1">
                                            @forelse (auth()->user()->elections as $election)
                                            <x-dropdown-link :href="route('voter.voting.index', ['election' => $election->id])">
                                                {{ $election->title }}
                                            </x-dropdown-link>
                                            @empty
                                            <div class="px-4 py-2 text-sm text-gray-500">Tidak ada voting</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </x-nav-link> --}}
                        @endif

                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.groups.index')" :active="request()->routeIs('admin.groups.*')">
                                {{ __('Groups') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.candidates.index')"
                                :active="request()->routeIs('admin.candidates.*')">
                                {{ __('Candidate') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.elections.index')"
                                :active="request()->routeIs('admin.elections.*')">
                                {{ __('Elections') }}
                            </x-nav-link>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
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
</nav>