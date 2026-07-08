<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Ward Offices
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">All Ward Offices</h3>
                    <a href="{{ route('admin.ward-offices.create') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        + Add Ward Office
                    </a>
                </div>

                @if ($wardOffices->isEmpty())
                    <p class="text-gray-600">No ward offices yet.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Ward Number</th>
                                <th class="py-2">Municipality</th>
                                <th class="py-2">District</th>
                                <th class="py-2">Total Requests</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wardOffices as $ward)
                                <tr class="border-b">
                                    <td class="py-2">{{ $ward->ward_number }}</td>
                                    <td class="py-2">{{ $ward->municipality }}</td>
                                    <td class="py-2">{{ $ward->district }}</td>
                                    <td class="py-2">{{ $ward->document_requests_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>