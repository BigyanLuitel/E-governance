<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">Manage Officers</h2>
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
                    <h3 class="font-semibold text-navy-900">All Officers</h3>
                    <a href="{{ route('admin.officers.create') }}"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">
                        + Add Officer
                    </a>
                </div>

                @if ($officers->isEmpty())
                    <p class="text-ink-600 text-sm px-6 py-8">No officers created yet.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-ink-600">
                                <th class="py-3 px-6 font-semibold">Name</th>
                                <th class="py-3 px-6 font-semibold">Email</th>
                                <th class="py-3 px-6 font-semibold">Ward Office</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($officers as $officer)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-6">{{ $officer->name }}</td>
                                    <td class="py-3 px-6 text-ink-600">{{ $officer->email }}</td>
                                    <td class="py-3 px-6">{{ $officer->wardOffice->ward_number ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>