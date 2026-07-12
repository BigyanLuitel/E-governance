<nav x-data="{ mobileOpen: false, adNow: '', adTimer: null, initClock() { const updateClock = () => { this.adNow = new Intl.DateTimeFormat('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true }).format(new Date()); }; updateClock(); this.adTimer = setInterval(updateClock, 1000); } }"
    x-init="initClock()">
    {{-- Blue identity band --}}
    <div class="bg-govblue-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- Emblem slot: replace src with your actual Nepal Sarkar / ward emblem file,
                e.g. place the image at public/images/emblem.png --}}
                <a href="{{ route('home') }}" class="shrink-0">
                    <div
                        class="w-14 h-14 rounded-full bg-white ring-2 ring-white/40 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/emblem.png') }}" alt="Emblem"
                            class="w-full h-full object-contain p-1.5"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full items-center justify-center hidden text-govblue-700">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12l1.75 1.75L14.5 10" />
                            </svg>
                        </div>
                    </div>
                </a>
                <div>
                    <p class="font-bold text-white text-lg leading-tight">Ward Office</p>
                    <p class="text-navy-50 text-sm leading-tight">Document Request &amp; Management System</p>
                    <p class="text-navy-50/70 text-xs leading-tight">Sinhadarbar, Kathmandu, Nepal</p>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-3 shrink-0">
                {{-- Flag graphic: place your GIF at public/images/flag.gif --}}
                <div class="w-12 h-16 shrink-0">
                    <img src="{{ asset('images/Nepal-flag.gif') }}" alt="Nepal flag"
                        class="w-full h-full object-contain"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <svg class="w-10 h-14 animate-wave origin-left hidden" viewBox="0 0 60 84"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 2 L40 2 L26 22 L40 22 L26 42 L2 42 L2 22 L14 22 Z M2 42 L2 82 L26 42 Z"
                            fill="#DC143C" stroke="white" stroke-width="2.2" stroke-linejoin="round" />
                        <circle cx="16" cy="12" r="4.5" fill="white" />
                        <circle cx="18.5" cy="10.5" r="4" fill="#1B4D89" />
                        <g fill="white">
                            <circle cx="15" cy="55" r="4.5" />
                            <path d="M15 48.5 L15 61.5 M8.5 55 L21.5 55 M10.5 49.5 L19.5 60.5 M19.5 49.5 L10.5 60.5"
                                stroke="white" stroke-width="1.4" />
                        </g>
                    </svg>
                </div>

                <div class="text-right text-white leading-tight">
                    <div class="flex items-center justify-end gap-2 whitespace-nowrap">
                        <span class="text-sm font-semibold min-h-[1.25rem]">A.D.</span>
                        <p class="text-sm font-semibold min-h-[1.25rem]" x-text="adNow">
                            {{ now()->format('l, F j, Y h:i:s A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- White nav row --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-12">
                <div class="hidden sm:flex sm:items-stretch">
                    <a href="{{ route('home') }}"
                        class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                              {{ request()->routeIs('home') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                        Home
                    </a>

                    @guest
                        <a href="{{ route('home') }}#services"
                            class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2 border-transparent hover:text-govblue-700">
                            Services
                        </a>
                        <a href="{{ route('home') }}#about"
                            class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2 border-transparent hover:text-govblue-700">
                            About
                        </a>
                        <a href="{{ route('home') }}#contact"
                            class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2 border-transparent hover:text-govblue-700">
                            Contact
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                                                                              {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                            Dashboard
                        </a>

                        @if (auth()->user()->isCitizen())
                            <a href="{{ route('requests.create') }}"
                                class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                                                                                                                              {{ request()->routeIs('requests.create') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                                New Request
                            </a>
                        @endif

                        @if (auth()->user()->isOfficer())
                            <a href="{{ route('officer.requests.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                                                                                                                              {{ request()->routeIs('officer.requests.*') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                                Review Requests
                            </a>
                        @endif

                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.requests.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                                                                                                                              {{ request()->routeIs('admin.requests.*') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                                All Requests
                            </a>
                            <a href="{{ route('admin.officers.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                                                                                                                              {{ request()->routeIs('admin.officers.*') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                                Officers
                            </a>
                            <a href="{{ route('admin.ward-offices.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                                                                                                                              {{ request()->routeIs('admin.ward-offices.*') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                                Ward Offices
                            </a>
                            <a href="{{ route('admin.document-types.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-navy-900 border-b-2
                                                                                                                              {{ request()->routeIs('admin.document-types.*') ? 'border-govblue-700 text-govblue-700' : 'border-transparent hover:text-govblue-700' }}">
                                Document Types
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Right side --}}
                <div class="hidden sm:flex sm:items-center gap-3">
                    {{-- Language toggle: cosmetic placeholder for now; full Nepali translation is a planned future
                    addition --}}
                    <button
                        class="flex items-center text-sm text-navy-900 px-2 py-1 border border-gray-300 rounded hover:bg-gray-50"
                        disabled title="Nepali language support coming soon">
                        EN
                        <svg class="ms-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm text-navy-900 px-3 py-1.5 rounded border border-gray-300 hover:bg-gray-50">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-1.5 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Log Out
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-navy-900 px-3 py-1.5 hover:text-govblue-700">
                            Log In
                        </a>
                        <a href="{{ route('register') }}"
                            class="text-sm text-white bg-govblue-700 px-3 py-1.5 rounded font-medium hover:bg-govblue-600">
                            Register
                        </a>
                    @endauth
                </div>

                {{-- Mobile menu button --}}
                <div class="flex items-center sm:hidden">
                    <button @click="mobileOpen = ! mobileOpen" class="text-navy-900 p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileOpen" class="sm:hidden bg-white border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')">Home</x-responsive-nav-link>
            @guest
                <x-responsive-nav-link :href="route('home') . '#services'">Services</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('home') . '#about'">About</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('home') . '#contact'">Contact</x-responsive-nav-link>
            @endguest
            @auth
                <x-responsive-nav-link :href="route('dashboard')">Dashboard</x-responsive-nav-link>
                @if (auth()->user()->isCitizen())
                    <x-responsive-nav-link :href="route('requests.create')">New Request</x-responsive-nav-link>
                @endif
                @if (auth()->user()->isOfficer())
                    <x-responsive-nav-link :href="route('officer.requests.index')">Review Requests</x-responsive-nav-link>
                @endif
                @if (auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.requests.index')">All Requests</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.officers.index')">Officers</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.ward-offices.index')">Ward Offices</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.document-types.index')">Document Types</x-responsive-nav-link>
                @endif
            @endauth
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            @auth
                <div class="px-4 text-navy-900 font-medium">{{ Auth::user()->name }}</div>
                <div class="mt-2 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')">Log In</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>