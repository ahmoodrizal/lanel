<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Promo Dashboard') }}
        </h2>
    </x-slot>
    <x-splade-modal>
        <div class="p-6 bg-white border-gray-200">
            <h3 class="mb-5 font-semibold">
                Edit Promo
            </h3>
            <x-splade-form :default="$promo" :action="route('promo.update', $promo)" method="put" class="p-4 space-y-4 bg-white rounded-md">
                <div class="grid grid-cols-1 sm:gap-6 sm:grid-cols-6 gap-y-2">
                    <x-splade-input name="old_price" type="hidden" />
                    <span class="sm:col-span-3">
                        <x-splade-input name="new_price" label="New Price" />
                    </span>
                    <span class="sm:col-span-3">
                        <x-splade-input name="description" label="Description" />
                    </span>
                    <span class="sm:col-span-4">
                        <x-splade-file name="image" label="Upload Image" filepond preview />
                    </span>
                </div>
                <x-splade-submit label="Save" />
            </x-splade-form>
        </div>
    </x-splade-modal>
</x-app-layout>
