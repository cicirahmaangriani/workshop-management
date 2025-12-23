<header class="bg-white shadow-sm sticky top-0 z-30">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Page Title & Breadcrumb -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                @if(request()->routeIs('dashboard'))
                    Dashboard
                @elseif(request()->routeIs('customers.*'))
                    Customers
                @elseif(request()->routeIs('vehicles.*'))
                    Vehicles
                @elseif(request()->routeIs('mechanics.*'))
                    Mechanics
                @elseif(request()->routeIs('spare-parts.*'))
                    Spare Parts
                @elseif(request()->routeIs('services.*'))
                    Services
                @elseif(request()->routeIs('invoices.*'))
                    Invoices
                @else
                    Workshop Management
                @endif
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ now()->format('l, d F Y') }}
            </p>
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
            <!-- User Menu -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" type="button" class="flex items-center space-x-3 p-2 hover:bg-gray-100 rounded-lg transition">
                    <div class="w-9 h-9 bg-gradient-to-br from-[#01205C] to-[#3273BA] rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50"
                     style="display: none;">
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile Settings
                    </a>
                    <hr class="my-2">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 text-left">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
