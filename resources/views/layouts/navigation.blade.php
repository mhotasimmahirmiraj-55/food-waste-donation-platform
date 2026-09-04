<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard', 'receiver.dashboard', 'donor.dashboard', 'volunteer.dashboard', 'admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (Auth::user()->role_id == 3)
                        <x-nav-link :href="route('receiver.donations')" :active="request()->routeIs('receiver.donations*')">
                            {{ __('Browse Food') }}
                        </x-nav-link>
                        <x-nav-link :href="route('receiver.claims')" :active="request()->routeIs('receiver.claims*')">
                            {{ __('My Claims') }}
                        </x-nav-link>
                        <x-nav-link :href="route('receiver.history')" :active="request()->routeIs('receiver.history')">
                            {{ __('Donation History') }}
                        </x-nav-link>
                        <x-nav-link :href="route('receiver.impact')" :active="request()->routeIs('receiver.impact')">
                            {{ __('Impact Record') }}
                        </x-nav-link>
                        <x-nav-link :href="route('receiver.milestones')" :active="request()->routeIs('receiver.milestones*')">
                            {{ __('Game & Milestone') }}
                        </x-nav-link>
                        <x-nav-link :href="route('receiver.bookmarks')" :active="request()->routeIs('receiver.bookmarks*')">
                            {{ __('Saved') }}
                        </x-nav-link>
                        <x-nav-link :href="route('receiver.help')" :active="request()->routeIs('receiver.help*')">
                            {{ __('Help Center') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown & Notifications -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Auth::user()->role_id == 3)
                    @php
                        $navUnreadNotifications = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
                    @endphp
                    <a href="{{ route('receiver.notifications') }}"
                       class="relative p-2 focus:outline-none transition me-3 rounded-full hover:bg-amber-50 group flex items-center justify-center"
                       title="Notifications">
                        <svg class="h-6 w-6 transition-transform group-hover:rotate-12 group-hover:scale-110 drop-shadow-sm" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="navBellGrad" x1="5" y1="3" x2="19" y2="19" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#fef08a"/>
                                    <stop offset="25%" stop-color="#fbbf24"/>
                                    <stop offset="65%" stop-color="#f59e0b"/>
                                    <stop offset="100%" stop-color="#d97706"/>
                                </linearGradient>
                                <linearGradient id="navClapperGrad" x1="12" y1="18" x2="12" y2="22" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#b45309"/>
                                    <stop offset="100%" stop-color="#78350f"/>
                                </linearGradient>
                            </defs>
                            <!-- Top Ring / Hanger -->
                            <path d="M12 2C10.7 2 9.6 3.1 9.6 4.4V5.1C10.4 4.7 11.2 4.5 12 4.5C12.8 4.5 13.6 4.7 14.4 5.1V4.4C14.4 3.1 13.3 2 12 2Z" fill="#b45309"/>
                            <!-- Clapper Tongue -->
                            <path d="M9.8 19C9.8 20.6 10.8 22 12 22C13.2 22 14.2 20.6 14.2 19H9.8Z" fill="url(#navClapperGrad)"/>
                            <!-- Realistic Flared Bell Body -->
                            <path d="M12 4.5C8.8 4.5 6.2 7 6.2 10.2V14.5C6.2 15.2 5.9 15.8 5.4 16.2L4.3 17.1C3.6 17.7 4 18.8 4.9 18.8H19.1C20 18.8 20.4 17.7 19.7 17.1L18.6 16.2C18.1 15.8 17.8 15.2 17.8 14.5V10.2C17.8 7 15.2 4.5 12 4.5Z" fill="url(#navBellGrad)"/>
                            <!-- Specular Highlight for 3D Brass Realism -->
                            <path d="M8.5 7.8C7.6 8.8 7.2 10.1 7.2 11.8V14.8" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" opacity="0.8"/>
                            <!-- Base Lip Edge Shadow -->
                            <path d="M5 18.8C7.5 19.4 16.5 19.4 19 18.8" stroke="#78350f" stroke-width="0.75" stroke-linecap="round" opacity="0.45"/>
                        </svg>
                        @if ($navUnreadNotifications > 0)
                            <span class="absolute top-1 right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full shadow-sm">
                                {{ $navUnreadNotifications > 99 ? '99+' : $navUnreadNotifications }}
                            </span>
                        @endif
                    </a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard', 'receiver.dashboard', 'donor.dashboard', 'volunteer.dashboard', 'admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (Auth::user()->role_id == 3)
                <x-responsive-nav-link :href="route('receiver.donations')" :active="request()->routeIs('receiver.donations*')">
                    {{ __('Browse Food') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('receiver.claims')" :active="request()->routeIs('receiver.claims*')">
                    {{ __('My Claims') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('receiver.history')" :active="request()->routeIs('receiver.history')">
                    {{ __('Donation History') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('receiver.impact')" :active="request()->routeIs('receiver.impact')">
                    {{ __('Impact Record') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('receiver.milestones')" :active="request()->routeIs('receiver.milestones*')">
                    {{ __('Game & Milestone') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('receiver.bookmarks')" :active="request()->routeIs('receiver.bookmarks*')">
                    {{ __('Saved') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('receiver.notifications')" :active="request()->routeIs('receiver.notifications*')">
                    {{ __('Notifications') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('receiver.help')" :active="request()->routeIs('receiver.help*')">
                    {{ __('Help Center') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
