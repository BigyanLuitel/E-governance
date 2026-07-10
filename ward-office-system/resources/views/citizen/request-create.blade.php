<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">
            New Document Request
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">

                <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data" x-data="{
                          fieldsMap: {{ Js::from($documentTypes->pluck('required_fields', 'id')) }},
                          selectedType: '',
                          get selectedFields() {
                              return this.selectedType ? this.fieldsMap[this.selectedType] : [];
                          }
                      }">
                    @csrf

                    <div class="mb-5 pb-5 border-b border-gray-100">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Document Type</label>
                        <select name="document_type_id" x-model="selectedType"
                            class="block w-full rounded-md border-gray-300 text-sm" required>
                            <option value="">-- Select a document type --</option>
                            @foreach ($documentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <template x-if="selectedFields.length">
                        <div class="mb-5 pb-5 border-b border-gray-100 space-y-4">
                            <p class="text-xs font-semibold text-ink-600 uppercase tracking-wide">Required Details</p>
                            <template x-for="field in selectedFields" :key="field">
                                <div>
                                    <label class="block text-sm font-medium text-ink-900 mb-1 capitalize"
                                        x-text="field.replace('_', ' ')"></label>
                                    <input type="text" :name="'form_data[' + field + ']'"
                                        class="block w-full rounded-md border-gray-300 text-sm" required>
                                </div>
                            </template>
                        </div>
                    </template>

                    <div class="mb-5 pb-5 border-b border-gray-100">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Purpose</label>
                        <textarea name="purpose" class="block w-full rounded-md border-gray-300 text-sm" rows="3"
                            placeholder="Briefly describe why you need this document"></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Supporting Document</label>
                        <input type="file" name="uploaded_file" class="block w-full text-sm">
                        <p class="text-xs text-ink-600 mt-1">PDF, JPG, or PNG. Max size 5MB.</p>
                    </div>

                    <button type="submit"
                        class="bg-navy-900 text-white px-5 py-2.5 text-sm font-medium hover:bg-navy-800">
                        Submit Request
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>