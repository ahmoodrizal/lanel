<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>
    <x-splade-modal>
        <div class="p-6 bg-white border-gray-200">
            <h3 class="mb-5 font-semibold">
                Edit User Roles
            </h3>
            <x-splade-form :default="$user" :action="route('user.update', $user)" method="put" class="p-4 space-y-4 bg-white rounded-md">
                <div class="grid grid-cols-1 sm:gap-6 sm:grid-cols-6 gap-y-2">
                    <span class="mb-4 sm:col-span-6">
                        <x-splade-select class="uppercase" name="roles" :options="$roles" label="Assign Roles" relation
                            choices />
                    </span>
                </div>
                <x-splade-submit label="Save" />
            </x-splade-form>
        </div>
    </x-splade-modal>
</x-app-layout>
