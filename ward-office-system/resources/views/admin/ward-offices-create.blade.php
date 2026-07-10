<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">Add New Ward Office</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">

                @if ($errors->any())
                    <div class="mb-4 px-4 py-3 border-l-4 border-maroon-800 bg-maroon-50 text-maroon-800 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.ward-offices.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Ward Number</label>
                        <input type="text" name="ward_number" value="{{ old('ward_number') }}" placeholder="e.g. Ward 5"
                            class="block w-full rounded-md border-gray-300 text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Municipality</label>
                        <input type="text" name="municipality" value="{{ old('municipality') }}"
                            class="block w-full rounded-md border-gray-300 text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">District</label>
                        <input type="text" name="district" value="{{ old('district') }}"
                            class="block w-full rounded-md border-gray-300 text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Contact Phone (optional)</label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone') }}"
                            class="block w-full rounded-md border-gray-300 text-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Address (optional)</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                            class="block w-full rounded-md border-gray-300 text-sm">
                    </div>

                    <button type="submit"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">
                        Create Ward Office
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>