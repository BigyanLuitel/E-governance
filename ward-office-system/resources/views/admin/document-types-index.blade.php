<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">Manage Document Types</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 border-l-4 border-govgreen-800 bg-govgreen-50 text-govgreen-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 sm:rounded-md">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-ink-600">
                            <th class="py-3 px-6 font-semibold">Name</th>
                            <th class="py-3 px-6 font-semibold">Required Fields</th>
                            <th class="py-3 px-6 font-semibold">Total Requests</th>
                            <th class="py-3 px-6 font-semibold">Status</th>
                            <th class="py-3 px-6 font-semibold"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentTypes as $type)
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-6 font-medium">{{ $type->name }}</td>
                                <td class="py-3 px-6 text-ink-600 text-xs">
                                    {{ implode(', ', array_map(fn($f) => str_replace('_', ' ', $f), $type->required_fields)) }}
                                </td>
                                <td class="py-3 px-6">{{ $type->document_requests_count }}</td>
                                <td class="py-3 px-6">
                                    <span
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wide
                                            @class(['text-govgreen-800' => $type->is_active, 'text-ink-600' => !$type->is_active])">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full @class(['bg-govgreen-800' => $type->is_active, 'bg-ink-600' => !$type->is_active])"></span>
                                        {{ $type->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-right">
                                    <form method="POST" action="{{ route('admin.document-types.toggle', $type) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-navy-700 font-medium hover:underline text-sm">
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