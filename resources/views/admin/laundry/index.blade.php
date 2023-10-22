<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laundry Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold">Laundry Area</h3>
                        <div>
                            @can('manage-laundries')
                                <Link modal href="{{ route('laundry.create') }}"
                                    class="px-3 py-2 mr-4 font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600">
                                Create order
                                </Link>
                            @endcan
                            <Link modal href="{{ route('laundry.order') }}"
                                class="px-3 py-2 font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
                            Claim Laundry
                            </Link>
                        </div>
                    </div>
                    <x-splade-table :for="$laundries">
                        @cell('action', $laundry)
                            <div class="space-x-2">
                                <Link modal href="{{ route('laundry.edit', $laundry) }}"
                                    class="font-semibold text-green-400 hover:text-green-700">Update</Link>
                            </div>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
