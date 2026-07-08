<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Officer
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

                <form method="POST" action="{{ route('admin.officers.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Temporary Password</label>
                        <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Assign to Ward Office</label>
                        <select name="ward_office_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="">-- Select ward office --</option>
                            @foreach ($wardOffices as $ward)
                                <option value="{{ $ward->id }}" @selected(old('ward_office_id') == $ward->id)>
                                    {{ $ward->ward_number }} — {{ $ward->municipality }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md">
                        Create Officer Account
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>