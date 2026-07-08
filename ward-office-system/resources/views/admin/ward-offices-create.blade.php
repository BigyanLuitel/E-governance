<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Ward Office
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
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
                        <label class="block font-medium text-sm text-gray-700">Ward Number</label>
                        <input type="text" name="ward_number" value="{{ old('ward_number') }}" placeholder="e.g. Ward 5"
                            class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Municipality</label>
                        <input type="text" name="municipality" value="{{ old('municipality') }}"
                            class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">District</label>
                        <input type="text" name="district" value="{{ old('district') }}"
                            class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Contact Phone (optional)</label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone') }}"
                            class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Address (optional)</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                            class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md">
                        Create Ward Office
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>