<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laundry Dashboard') }}
        </h2>
    </x-slot>
    <x-splade-modal>
        <div class="p-6 bg-white border-gray-200">
            <h3 class="mb-5 font-semibold">
                Claim Laundry Order
            </h3>
            <x-splade-form :action="route('laundry.claim')" method="put" class="p-4 space-y-4 bg-white rounded-md">
                <div class="grid grid-cols-1 sm:gap-6 sm:grid-cols-6 gap-y-2">
                    <span class="sm:col-span-3">
                        <x-splade-input name="claim_code" label="Claim code" />
                    </span>
                    <span class="sm:col-span-3">
                        <x-splade-input name="laundry_id" label="Laundry ID" />
                    </span>
                </div>
                <x-splade-submit label="Create order" />
            </x-splade-form>
        </div>
    </x-splade-modal>
</x-app-layout>
