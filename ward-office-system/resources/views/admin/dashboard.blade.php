<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <p>Welcome, {{ auth()->user()->name }}.</p>

            {{-- Stats grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-sm text-gray-500">Total Requests</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_requests'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-sm text-gray-500">Pending</p>
                    <p class="text-2xl font-semibold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-sm text-gray-500">Under Review</p>
                    <p class="text-2xl font-semibold text-blue-600">{{ $stats['under_review'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-sm text-gray-500">Approved</p>
                    <p class="text-2xl font-semibold text-green-600">{{ $stats['approved'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-sm text-gray-500">Rejected</p>
                    <p class="text-2xl font-semibold text-red-600">{{ $stats['rejected'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-sm text-gray-500">Officers</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_officers'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-sm text-gray-500">Ward Offices</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_ward_offices'] }}</p>
                </div>
            </div>

            {{-- Quick links --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Manage</h3>
                <div class="flex gap-4 flex-wrap">
                    <a href="{{ route('admin.requests.index') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        View All Requests
                    </a>
                    <a href="{{ route('admin.officers.index') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        Manage Officers
                    </a>
                    <a href="{{ route('admin.ward-offices.index') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        Manage Ward Offices
                    </a>
                    <a href="{{ route('admin.document-types.index') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        Manage Document Types
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>