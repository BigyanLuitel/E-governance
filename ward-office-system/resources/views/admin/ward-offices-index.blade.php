<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">Manage Ward Offices</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 border-l-4 border-govgreen-800 bg-govgreen-50 text-govgreen-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 sm:rounded-md">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-navy-900">All Ward Offices</h3>
                    <a href="{{ route('admin.ward-offices.create') }}"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">
                        + Add Ward Office
                    </a>
                </div>

                @if ($wardOffices->isEmpty())
                    <p class="text-ink-600 text-sm px-6 py-8">No ward offices yet.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-ink-600">
                                <th class="py-3 px-6 font-semibold">Ward Number</th>
                                <th class="py-3 px-6 font-semibold">Municipality</th>
                                <th class="py-3 px-6 font-semibold">District</th>
                                <th class="py-3 px-6 font-semibold">Total Requests</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wardOffices as $ward)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-6">{{ $ward->ward_number }}</td>
                                    <td class="py-3 px-6">{{ $ward->municipality }}</td>
                                    <td class="py-3 px-6 text-ink-600">{{ $ward->district }}</td>
                                    <td class="py-3 px-6">{{ $ward->document_requests_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>