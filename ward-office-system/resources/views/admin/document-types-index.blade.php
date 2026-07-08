<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Document Types
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
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Name</th>
                            <th class="py-2">Required Fields</th>
                            <th class="py-2">Total Requests</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentTypes as $type)
                            <tr class="border-b">
                                <td class="py-2">{{ $type->name }}</td>
                                <td class="py-2 text-sm text-gray-500">
                                    {{ implode(', ', array_map(fn($f) => str_replace('_', ' ', $f), $type->required_fields)) }}
                                </td>
                                <td class="py-2">{{ $type->document_requests_count }}</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 rounded text-xs @class([
                                        'bg-green-100 text-green-800' => $type->is_active,
                                        'bg-gray-200 text-gray-700' => !$type->is_active,
                                    ])">
                                        {{ $type->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <form method="POST" action="{{ route('admin.document-types.toggle', $type) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-blue-600 underline text-sm">
                                            {{ $type->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>