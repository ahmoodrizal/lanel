<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-5 font-semibold">
                        Edit Shop
                    </h3>
                    <x-splade-form :default="$shop" :action="route('shop.update', $shop)" method='put'
                        class="p-4 mb-8 space-y-4 bg-white rounded-md">
                        <div class="grid grid-cols-1 sm:gap-6 sm:grid-cols-6 gap-y-2">
                            <span class="sm:col-span-2">
                                <x-splade-input name="name" label="Shop Name" />
                            </span>
                            <span class="sm:col-span-2">
                                <x-splade-input name="city" label="City" />
                            </span>
                            <span class="sm:col-span-2">
                                <x-splade-input name="location" label="Location" />
                            </span>
                            <span class="sm:col-span-2">
                                <x-splade-input name="whatsapp" label="Whatsapp" />
                            </span>
                            <span class="sm:col-span-2">
                                <x-splade-input name="description" label="Description" />
                            </span>
                            <span class="sm:col-span-2">
                                <x-splade-input name="price" label="Price" />
                            </span>
                            <span class="sm:col-span-2">
                                <p>Service</p>
                                <x-splade-checkbox name="delivery" value="1" label="Delivery Service" />
                                <x-splade-checkbox name="pickup" value="1" label="Pickup Service" />
                            </span>
                            <span class="sm:col-span-4">
                                <x-splade-file name="image" label="Upload Image" preview />
                            </span>
                        </div>
                        <x-splade-submit label="Save" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
