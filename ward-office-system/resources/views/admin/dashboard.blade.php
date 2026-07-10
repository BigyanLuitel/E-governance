<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <p class="text-ink-600 text-sm">Welcome, {{ auth()->user()->name }}.</p>

            {{-- Stats grid --}}
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-200 border border-gray-200 sm:rounded-md overflow-hidden">
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Total Requests</p>
                    <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total_requests'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Pending</p>
                    <p class="text-2xl font-bold text-ink-900 mt-1">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Under Review</p>
                    <p class="text-2xl font-bold text-navy-700 mt-1">{{ $stats['under_review'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Approved</p>
                    <p class="text-2xl font-bold text-govgreen-800 mt-1">{{ $stats['approved'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Rejected</p>
                    <p class="text-2xl font-bold text-maroon-800 mt-1">{{ $stats['rejected'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Officers</p>
                    <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total_officers'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Ward Offices</p>
                    <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total_ward_offices'] }}</p>
                </div>
            </div>

            {{-- Quick links --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Manage</h3>
                <div class="flex gap-3 flex-wrap">
                    <a href="{{ route('admin.requests.index') }}"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">
                        View All Requests
                    </a>
                    <a href="{{ route('admin.officers.index') }}"
                        class="border border-navy-900 text-navy-900 px-4 py-2 text-sm font-medium hover:bg-navy-50">
                        Manage Officers
                    </a>
                    <a href="{{ route('admin.ward-offices.index') }}"
                        class="border border-navy-900 text-navy-900 px-4 py-2 text-sm font-medium hover:bg-navy-50">
                        Manage Ward Offices
                    </a>
                    <a href="{{ route('admin.document-types.index') }}"
                        class="border border-navy-900 text-navy-900 px-4 py-2 text-sm font-medium hover:bg-navy-50">
                        Manage Document Types
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>