<footer class="bg-govblue-700 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">

        {{-- Identity block --}}
        <div class="flex items-center gap-4 pb-8 border-b border-white/15">
            <div
                class="w-14 h-14 rounded-full bg-white ring-2 ring-white/30 flex items-center justify-center overflow-hidden shrink-0">
                <img src="{{ asset('images/emblem.png') }}" alt="Emblem" class="w-full h-full object-contain p-1.5"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="w-full h-full items-center justify-center hidden text-govblue-700">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12l1.75 1.75L14.5 10" />
                    </svg>
                </div>
            </div>
            <div>
                <p class="font-bold text-white text-lg leading-tight">Ward Office</p>
                <p class="text-navy-50 text-sm leading-tight">Document Request &amp; Management System</p>
                <p class="text-navy-50/70 text-xs leading-tight mt-0.5">Sinhadarbar, Kathmandu, Nepal</p>
            </div>
        </div>

        {{-- Two columns --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 py-8 border-b border-white/15">
            <div>
                <h3 class="text-white font-semibold text-sm mb-3">Office Hours</h3>
                <div class="text-navy-50 text-sm space-y-1">
                    <div class="flex justify-between max-w-xs">
                        <span>Sunday – Friday</span>
                        <span>10:00 AM – 5:00 PM</span>
                    </div>
                    <p class="text-navy-50/70 text-xs pt-1">Closed on Saturdays and public holidays</p>
                </div>
            </div>

            <div>
                <h3 class="text-white font-semibold text-sm mb-3">Quick Links</h3>
                <ul class="text-navy-50 text-sm space-y-1.5">
                    <li><a href="{{ route('home') }}" class="hover:text-white hover:underline">Home</a></li>
                    <li><a href="{{ route('home') }}#services" class="hover:text-white hover:underline">Available
                            Services</a></li>
                    @guest
                        <li><a href="{{ route('login') }}" class="hover:text-white hover:underline">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white hover:underline">Register</a></li>
                    @endguest
                </ul>
            </div>
        </div>

        {{-- Contact / social --}}
        <div class="flex flex-wrap items-center justify-between gap-4 pt-6">
            <div class="flex items-center gap-4 text-navy-50">
                {{-- Placeholder social links — replace href="#" with real profiles when available --}}
                <a href="#" class="hover:text-white" aria-label="Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.5-4.5-10-10-10S2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7C18.3 21.1 22 17 22 12z" />
                    </svg>
                </a>
                <a href="#" class="hover:text-white" aria-label="X">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.9 2H22l-7.6 8.7L23 22h-6.9l-5.4-6.7L4.5 22H1.4l8.1-9.3L1 2h7l4.9 6.1L18.9 2z" />
                    </svg>
                </a>
            </div>

            <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-navy-50 text-sm">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    info@wardoffice.gov.np
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    01-XXXXXXX
                </span>
            </div>
        </div>

        <p class="text-navy-50/60 text-xs text-center mt-8">
            &copy; {{ date('Y') }} Ward Office Document Request &amp; Management System. All rights reserved.
        </p>
    </div>
</footer>