<nav x-data="{ mobileOpen: false }">
    {{-- Utility bar --}}
    <div class="bg-navy-900 text-white text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-8">
            <span>Ward Office Document Request &amp; Management System</span>
            <span class="hidden sm:inline">Helpline: 01-XXXXXXX</span>
        </div>
    </div>

    {{-- Identity band --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center gap-4">
            {{-- Seal placeholder --}}
            <div class="w-12 h-12 rounded-full border-2 border-navy-900 flex items-center justify-center shrink-0">
                <span class="font-bold text-navy-900 text-sm">WO</span>
            </div>
            <div>
                <p class="font-bold text-navy-900 text-lg leading-tight">Ward Office</p>
                <p class="text-ink-600 text-sm leading-tight">Document Request &amp; Management System</p>
            </div>
        </div>
    </div>

    {{-- Nav bar --}}
    <div class="bg-navy-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-12">
                <div class="hidden sm:flex sm:items-stretch">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 text-sm font-semibold text-white border-b-2
                              {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'border-white' : 'border-transparent hover:border-navy-50' }}">
                        Dashboard
                    </a>

                    @auth
                        @if (auth()->user()->isCitizen())
                            <a href="{{ route('requests.create') }}"
                                class="flex items-center px-4 text-sm font-semibold text-white border-b-2
                                              {{ request()->routeIs('requests.create') ? 'border-white' : 'border-transparent hover:border-navy-50' }}">
                                New Request
                            </a>
                        @endif

                        @if (auth()->user()->isOfficer())
                            <a href="{{ route('officer.requests.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-white border-b-2
                                              {{ request()->routeIs('officer.requests.*') ? 'border-white' : 'border-transparent hover:border-navy-50' }}">
                                Review Requests
                            </a>
                        @endif

                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.requests.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-white border-b-2
                                              {{ request()->routeIs('admin.requests.*') ? 'border-white' : 'border-transparent hover:border-navy-50' }}">
                                All Requests
                            </a>
                            <a href="{{ route('admin.officers.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-white border-b-2
                                              {{ request()->routeIs('admin.officers.*') ? 'border-white' : 'border-transparent hover:border-navy-50' }}">
                                Officers
                            </a>
                            <a href="{{ route('admin.ward-offices.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-white border-b-2
                                              {{ request()->routeIs('admin.ward-offices.*') ? 'border-white' : 'border-transparent hover:border-navy-50' }}">
                                Ward Offices
                            </a>
                            <a href="{{ route('admin.document-types.index') }}"
                                class="flex items-center px-4 text-sm font-semibold text-white border-b-2
                                              {{ request()->routeIs('admin.document-types.*') ? 'border-white' : 'border-transparent hover:border-navy-50' }}">
                                Document Types
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Right side: user menu --}}
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm text-white px-3 py-1.5 rounded border border-navy-50/30 hover:bg-navy-800">
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
                </div>

                {{-- Mobile menu button --}}
                <div class="flex items-center sm:hidden">
                    <button @click="mobileOpen = ! mobileOpen" class="text-white p-2">
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
    <div x-show="mobileOpen" class="sm:hidden bg-navy-700 border-t border-navy-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')">Dashboard</x-responsive-nav-link>
            @auth
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
        <div class="pt-4 pb-3 border-t border-navy-800">
            <div class="px-4 text-white font-medium">{{ Auth::user()->name }}</div>
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
        </div>
    </div>
</nav>