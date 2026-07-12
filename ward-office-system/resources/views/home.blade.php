<x-app-layout>
    {{-- Hero section: photo with overlay caption --}}
    {{-- Replace the image below with your own, e.g. public/images/hero.jpg --}}
    <div class="relative bg-navy-900">
        <img src="{{ asset('images/hero.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-70"
            onerror="this.style.display='none';">
        <div class="absolute inset-0 bg-gradient-to-t from-navy-900/90 via-navy-900/50 to-navy-900/20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28">
            <h1 class="text-2xl sm:text-3xl font-bold max-w-2xl leading-snug text-white">
                Online Civil Document Services
            </h1>
            <p class="mt-3 text-navy-50 max-w-xl text-sm">
                This portal is used to apply for birth certificates, death certificates,
                marriage certificates, and citizenship recommendations, and to check the
                status of applications already submitted.
            </p>

            <div class="mt-6 flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-white text-navy-900 px-5 py-2.5 text-sm font-semibold hover:bg-navy-50">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-white text-navy-900 px-5 py-2.5 text-sm font-semibold hover:bg-navy-50">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="border border-white text-white px-5 py-2.5 text-sm font-medium hover:bg-white/10">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- Available services --}}
    <div id="services" class="py-10 scroll-mt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-lg font-bold text-navy-900 mb-1">Available Services</h2>
            <p class="text-sm text-ink-600 mb-6">Document types currently accepted by this ward office.</p>

            <div class="bg-white border border-gray-200 sm:rounded-md divide-y divide-gray-100">
                @foreach ($documentTypes as $type)
                    <div class="px-6 py-4 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-navy-900">{{ $type->name }}</p>
                            @if ($type->description)
                                <p class="text-sm text-ink-600 mt-0.5">{{ $type->description }}</p>
                            @endif
                        </div>
                        @auth
                            <a href="{{ route('requests.create') }}"
                                class="text-navy-700 text-sm font-medium hover:underline shrink-0 ml-4">
                                Apply
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-navy-700 text-sm font-medium hover:underline shrink-0 ml-4">
                                Login to apply
                            </a>
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Procedure --}}
    <div class="pb-14">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-lg font-bold text-navy-900 mb-1">Application Procedure</h2>
            <p class="text-sm text-ink-600 mb-6">The following steps apply to all document requests submitted through
                this portal.</p>

            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <ol class="space-y-3 text-sm">
                    <li class="flex gap-3">
                        <span class="text-navy-700 font-semibold shrink-0">1.</span>
                        <span class="text-ink-900">Register for an account and submit a document request with the
                            required details.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-navy-700 font-semibold shrink-0">2.</span>
                        <span class="text-ink-900">The request is reviewed by an officer at the relevant ward
                            office.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-navy-700 font-semibold shrink-0">3.</span>
                        <span class="text-ink-900">The applicant is notified of the outcome and may track the status of
                            the request at any time from their dashboard.</span>
                    </li>
                </ol>
            </div>
            {{-- About --}}
            <div id="about" class="pb-14 scroll-mt-16">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                        <h2 class="text-lg font-bold text-navy-900 mb-3">About This Portal</h2>
                        <p class="text-sm text-ink-600 leading-relaxed max-w-3xl">
                            The Ward Office Document Request and Management System allows citizens to apply
                            for official ward-level documents online instead of visiting the office in person.
                            Applications submitted through this portal are reviewed by ward officers, and
                            applicants can track the status of their request at any stage of the process.
                            This system is intended to reduce processing time, minimize repeat visits, and
                            maintain a transparent record of all document requests handled by the ward office.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Contact --}}
            <div id="contact" class="pb-14 scroll-mt-16">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h2 class="text-lg font-bold text-navy-900 mb-1">Contact</h2>
                    <p class="text-sm text-ink-600 mb-6">For queries not related to an existing application, reach the
                        ward office directly.</p>

                    <div
                        class="bg-white border border-gray-200 sm:rounded-md p-6 grid grid-cols-1 sm:grid-cols-3 gap-6 text-sm">
                        <div>
                            <p class="text-ink-600 text-xs uppercase tracking-wide mb-1">Address</p>
                            <p class="text-navy-900 font-medium">Sinhadarbar, Kathmandu, Nepal</p>
                        </div>
                        <div>
                            <p class="text-ink-600 text-xs uppercase tracking-wide mb-1">Phone</p>
                            <p class="text-navy-900 font-medium">01-XXXXXXX</p>
                        </div>
                        <div>
                            <p class="text-ink-600 text-xs uppercase tracking-wide mb-1">Email</p>
                            <p class="text-navy-900 font-medium">info@wardoffice.gov.np</p>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>