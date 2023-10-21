<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="pb-5 font-semibold">
                            Manage Users
                        </h3>
                        <div class="p-4">
                            <Link href="{{ route('user.create') }}"
                                class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-700">Create New
                            User
                            </Link>
                        </div>
                    </div>
                    <x-splade-table :for="$users">
                        @cell('action', $user)
                            <div class="space-x-2">
                                <Link modal href="{{ route('user.edit', $user) }}"
                                    class="font-semibold text-sky-400 hover:text-sky-700">Edit</Link>
                                <Link href="{{ route('user.destroy', $user) }}" method="DELETE"
                                    class="font-semibold text-red-400 hover:text-red-700" confirm="Delete user data..."
                                    confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No">Delete
                                </Link>
                            </div>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
