<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-5 font-semibold">
                        Create New User
                    </h3>
                    <x-splade-form :action="route('user.store')" class="p-4 mb-8 space-y-4 bg-white rounded-md">
                        <div class="grid grid-cols-1 sm:gap-6 sm:grid-cols-6 gap-y-2">
                            <span class="sm:col-span-2">
                                <x-splade-input name="name" label="Name" />
                            </span>
                            <span class="sm:col-span-2">
                                <x-splade-input name="username" label="Username" />
                            </span>
                            <span class="sm:col-span-2">
                                <x-splade-input name="email" label="Email Address" />
                            </span>
                            <span class="mb-4 sm:col-span-3">
                                <x-splade-select name="role" :options="$roles" label="Assign Roles" choices />
                            </span>
                            <span class="mb-4 sm:col-span-3">
                                <x-splade-input name="password" label="Password" type="password" />
                            </span>
                        </div>
                        <x-splade-submit label="Create" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
