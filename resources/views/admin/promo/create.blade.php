<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create New Promo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-5 font-semibold">
                        Create Promo
                    </h3>
                    <x-splade-form :action="route('promo.store')" class="p-4 mb-8 space-y-4 bg-white rounded-md">
                        <div class="grid grid-cols-1 sm:gap-6 sm:grid-cols-6 gap-y-2">
                            <span class="sm:col-span-3">di
                                <x-splade-input name="new_price" label="New Price" />
                            </span>
                            <span class="sm:col-span-3">
                                <x-splade-input name="description" label="Description" />
                            </span>
                            <span class="sm:col-span-4">
                                <x-splade-file name="image" label="Upload Image" preview />
                            </span>
                        </div>
                        <x-splade-submit label="Create" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
