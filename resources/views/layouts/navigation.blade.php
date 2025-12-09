<aside class="h-full flex flex-col md:h-screen md:sticky md:top-0">
    <!-- Logo -->
    <div class="p-6 border-b border-gray-200">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-gray-800">
            {{ config('app.name', 'MY APP') }}
        </a>
    </div>
    <!-- Nav Links -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>

            {{ __('Dashboard') }}
        </x-nav-link>
        <x-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
            {{ __('Master Pagu') }}
        </x-nav-link>

        <x-nav-link :href="route('pokir.bulk')" :active="request()->routeIs('pokir.bulk')">
            {{ __('Input Usulan') }}
        </x-nav-link>
    
        <x-nav-link :href="route('pokir.index')" :active="request()->routeIs('pokir.index')">
            {{ __('Data Pokir') }}
        </x-nav-link>
    
        <x-nav-link :href="route('master.index')" :active="request()->routeIs('master.*')">
            {{ __('Master Data') }}
        </x-nav-link>
    
    </nav>
    <!-- User Dropdown -->
    <div x-data="{ open: false }" class="px-4 py-4 border-t border-gray-200">
        <button @click="open = !open"
            class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-left bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
            <span>{{ Auth::user()->name }}</span>
            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-cloak class="mt-2 space-y-1 bg-white rounded-lg shadow-inner text-sm text-gray-700">
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 hover:bg-gray-100 rounded-lg">{{ __('Profile') }}</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</aside>