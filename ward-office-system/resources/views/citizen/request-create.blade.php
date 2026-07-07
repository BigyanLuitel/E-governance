<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Document Request
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data" x-data="{
                          fieldsMap: {{ Js::from($documentTypes->pluck('required_fields', 'id')) }},
                          selectedType: '',
                          get selectedFields() {
                              return this.selectedType ? this.fieldsMap[this.selectedType] : [];
                          }
                      }">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Document Type</label>
                        <select name="document_type_id" x-model="selectedType"
                            class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="">-- Select a document type --</option>
                            @foreach ($documentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <template x-for="field in selectedFields" :key="field">
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 capitalize"
                                x-text="field.replace('_', ' ')"></label>
                            <input type="text" :name="'form_data[' + field + ']'"
                                class="mt-1 block w-full rounded-md border-gray-300" required>
                        </div>
                    </template>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Purpose</label>
                        <textarea name="purpose" class="mt-1 block w-full rounded-md border-gray-300"
                            rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Supporting Document</label>
                        <input type="file" name="uploaded_file" class="mt-1 block w-full">
                    </div>

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md">
                        Submit Request
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>