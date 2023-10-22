<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Shop Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold">
                            Manage Shop
                        </h3>
                        @if (Auth::user()->shop != null)
                            <Link href="{{ route('shop.edit', Auth::user()->shop) }}"
                                class="px-3 py-2 font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600">
                            Edit Shop
                            </Link>
                        @endif
                    </div>
                    @if (Auth::user()->shop == null)
                        <div class="p-4 text-orange-700 bg-orange-100 border-l-4 border-orange-500 rounded-md"
                            role="alert">
                            <div class="flex items-center justify-between">
                                <div class="">
                                    <p class="font-bold">Warning</p>
                                    <p>Currently you don't have a shop, let's create one</p>
                                </div>
                                <Link href="{{ route('shop.create') }}"
                                    class="px-3 py-2 font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600">
                                Create Shop
                                </Link>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->shop != null)
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                            <span class="sm:col-span-3">
                                <h3 class="mb-5 font-bold">
                                    Shop Banner
                                </h3>
                                @if (Auth::user()->shop->image != null)
                                    <div class="">
                                        <img width="300" height="300" class="rounded-md"
                                            src="{{ asset('/storage/shops/' . Auth::user()->shop->image) }}"
                                            alt="">
                                    </div>
                                @endif
                            </span>
                            <span class="sm:col-span-3">
                                <dl>
                                    <div class="mb-3">
                                        <dt class="font-bold">Shop Name</dt>
                                        <dd class="pl-3 font-semibold">{{ Auth::user()->shop->name }}</dd>
                                    </div>
                                    <div class="mb-3">
                                        <dt class="font-bold">Shop Address</dt>
                                        <dd class="pl-3 font-semibold">{{ Auth::user()->shop->city }}</dd>
                                        <dd class="pl-3 font-semibold">{{ Auth::user()->shop->location }}</dd>
                                    </div>
                                    <div class="mb-3">
                                        <dt class="font-bold">Shop Detail</dt>
                                        <dd class="pl-3 font-semibold">Tagline : {{ Auth::user()->shop->description }}
                                        </dd>
                                        <dd class="pl-3 font-semibold">Whatsapp Number :
                                            {{ Auth::user()->shop->whatsapp }}
                                        </dd>
                                        <dd class="pl-3 font-semibold">Current Price :
                                            Rp.{{ Auth::user()->shop->price }}
                                            / kg
                                        </dd>
                                        @if (Auth::user()->shop?->promo != null)
                                            <dd class="pl-3 font-semibold text-orange-600">Promo Price :
                                                Rp.{{ Auth::user()->shop->promo->new_price }}
                                                / kg
                                            </dd>
                                        @endif
                                        <dd class="pl-3 font-semibold">Current Rate : {{ Auth::user()->shop->rate }}
                                            / 5
                                        </dd>
                                    </div>
                                    <div class="mb-3">
                                        <dt class="font-bold">Service</dt>
                                        <dd class="pl-3 font-semibold">
                                            {{ Auth::user()->shop->delivery ? 'Delivery' : null }}</dd>
                                        <dd class="pl-3 font-semibold">
                                            {{ Auth::user()->shop->pickup ? 'Pickup' : null }}
                                        </dd>
                                    </div>
                                </dl>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
