<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">Add New Officer</h2>
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

                <form method="POST" action="{{ route('admin.officers.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="block w-full rounded-md border-gray-300 text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="block w-full rounded-md border-gray-300 text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Temporary Password</label>
                        <input type="password" name="password" class="block w-full rounded-md border-gray-300 text-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Assign to Ward Office</label>
                        <select name="ward_office_id" class="block w-full rounded-md border-gray-300 text-sm" required>
                            <option value="">-- Select ward office --</option>
                            @foreach ($wardOffices as $ward)
                                <option value="{{ $ward->id }}" @selected(old('ward_office_id') == $ward->id)>
                                    {{ $ward->ward_number }} — {{ $ward->municipality }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">
                        Create Officer Account
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>