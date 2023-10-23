@inject('carbon', 'Carbon\Carbon')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Promo Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold">
                            Manage Promo
                        </h3>
                        @if (Auth::user()->promo != null)
                            <div class="gap-x-3">
                                <Link modal href="{{ route('promo.edit', Auth::user()->promo) }}"
                                    class="px-3 py-2 mr-4 font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600">
                                Edit Promo
                                </Link>
                                <Link href="{{ route('promo.destroy', Auth::user()->promo) }}" method="DELETE"
                                    class="px-3 py-2 font-medium text-white bg-red-500 rounded-md hover:bg-red-600"
                                    confirm="Delete promo data..." confirm-text="Are you sure?" confirm-button="Yes"
                                    cancel-button="No">Delete
                                </Link>
                            </div>
                        @endif
                    </div>
                    @if (Auth::user()->promo == null)
                        <div class="p-4 text-orange-700 bg-orange-100 border-l-4 border-orange-500 rounded-md"
                            role="alert">
                            <div class="flex items-center justify-between">
                                <div class="">
                                    <p class="font-bold">Warning</p>
                                    <p>Currently you don't have a promo, let's create one</p>
                                </div>
                                <Link href="{{ route('promo.create') }}"
                                    class="px-3 py-2 font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600">
                                Create Promo
                                </Link>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->promo != null)
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                            <span class="sm:col-span-3">
                                <dl>
                                    <div class="mb-3">
                                        <dt class="font-bold">Description</dt>
                                        <dd class="pl-3 font-semibold">{{ Auth::user()->promo->description }}</dd>
                                    </div>
                                    <div class="mb-3">
                                        <dt class="font-bold">Old Price</dt>
                                        <dd class="pl-3 font-semibold">Rp. {{ Auth::user()->promo->old_price }} /kg</dd>
                                    </div>
                                    <div class="mb-3">
                                        <dt class="font-bold">New Price</dt>
                                        <dd class="pl-3 font-semibold">Rp. {{ Auth::user()->promo->new_price }}/ kg</dd>
                                    </div>
                                    <div class="mb-3">
                                        <dt class="font-bold">Created At</dt>
                                        <dd class="pl-3 font-semibold">
                                            {{ $carbon::parse(Auth::user()->promo->created_at)->format('d F Y') }}
                                        </dd>
                                    </div>
                            </span>
                            <span class="sm:col-span-3">
                                <h3 class="mb-3 font-bold">
                                    Promo Banner
                                </h3>
                                @if (Auth::user()->promo->image != null)
                                    <img class="object-cover w-auto h-auto rounded-md shadow-md max-h-72"
                                        src="{{ asset('/storage/promo/' . Auth::user()->promo->image) }}"
                                        alt="">
                                @endif
                            </span>
                            </dl>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
