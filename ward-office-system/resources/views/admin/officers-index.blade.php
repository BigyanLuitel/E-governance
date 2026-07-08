<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Officers
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
                    <h3 class="text-lg font-medium">All Officers</h3>
                    <a href="{{ route('admin.officers.create') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        + Add Officer
                    </a>
                </div>

                @if ($officers->isEmpty())
                    <p class="text-gray-600">No officers created yet.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Name</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">Ward Office</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($officers as $officer)
                                <tr class="border-b">
                                    <td class="py-2">{{ $officer->name }}</td>
                                    <td class="py-2">{{ $officer->email }}</td>
                                    <td class="py-2">{{ $officer->wardOffice->ward_number ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>