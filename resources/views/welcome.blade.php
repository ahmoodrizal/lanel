@if (Route::has('login'))
    <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
        @auth
            <Link href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Dashboard
            </Link>
        @else
            <Link href="{{ route('login') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Log in</Link>

            @if (Route::has('register'))
                <Link href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline dark:text-gray-500">
                Register</Link>
            @endif
        @endauth
    </div>
@endif

<section class="flex items-center justify-center min-h-screen py-2 bg-violet-100">
    <div class="mx-auto max-w-[43rem]">
        <div class="text-center">
            <p class="text-lg font-medium leading-8 text-indigo-600/95">Introducing Laundry Admin Panel</p>
            <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-black">Just a simple
                Dashboard to organize everything</h1>
            <p class="mt-3 text-lg leading-relaxed text-slate-600">Specify helps you manage your store and transactions
                on one page.</p>
        </div>
    </div>
</section>
