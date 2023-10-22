<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laundry Dashboard') }}
        </h2>
    </x-slot>
    <x-splade-modal>
        <div class="p-6 bg-white border-gray-200">
            <h3 class="mb-5 font-semibold">
                Update Laundry
            </h3>
            <x-splade-form :default="$laundry" :action="route('laundry.update', $laundry)" method="put" class="p-4 space-y-4 bg-white rounded-md">
                <div class="grid grid-cols-1 sm:gap-6 sm:grid-cols-6 gap-y-2">
                    <span class="sm:col-span-2">
                        <x-splade-input name="weight" label="Weight" />
                    </span>
                    <span class="sm:col-span-4">
                        <x-splade-input name="description" label="Description" />
                    </span>
                    <span class="sm:col-span-4">
                        <x-splade-textarea name="address" label="Address" autosize />
                    </span>
                    <span class="sm:col-span-2">
                        <p>Service</p>
                        @if (Auth::user()->shop->pickup)
                            <x-splade-checkbox name="with_pickup" value="1" label="Pickup Service" />
                        @endif
                        @if (Auth::user()->shop->delivery)
                            <x-splade-checkbox name="with_delivery" value="1" label="Delivery Service" />
                        @endif
                    </span>
                    <span class="sm:col-span-4">
                        <x-splade-select name="status" choices>
                            <option value="Queue">Queue</option>
                            <option value="Pickup">Pickup</option>
                            <option value="Process">Process</option>
                            <option value="Washing">Washing</option>
                            <option value="Dried">Dried</option>
                            <option value="Ironed">Ironed</option>
                            <option value="Done">Done</option>
                            <option value="Delivery">Delivery</option>
                        </x-splade-select>
                    </span>
                </div>
                <x-splade-submit label="Save" />
            </x-splade-form>
        </div>
    </x-splade-modal>
</x-app-layout>
