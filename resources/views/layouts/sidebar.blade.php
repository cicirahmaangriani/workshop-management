<div x-data="{ open: false }">
    <nav class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-[#01205C] to-[#3273BA] transform transition-transform duration-300 lg:translate-x-0" :class="open ? 'translate-x-0' : '-translate-x-full'">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-white/10">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#01205C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg">WorkshopPro</h1>
                    <p class="text-blue-200 text-xs">Management System</p>
                </div>
            </div>
            <button @click="open = false" class="lg:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 px-4 py-6 overflow-y-auto">
            <nav class="space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Customers -->
                <a href="{{ route('customers.index') }}" 
                   class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('customers.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="font-medium">Customers</span>
                </a>

                <!-- Vehicles -->
                <a href="{{ route('vehicles.index') }}" 
                   class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('vehicles.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <span class="font-medium">Vehicles</span>
                </a>

                <!-- Mechanics -->
                <a href="{{ route('mechanics.index') }}" 
                   class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('mechanics.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Mechanics</span>
                </a>

                <!-- Spare Parts -->
                <a href="{{ route('spare-parts.index') }}" 
                   class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('spare-parts.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="font-medium">Spare Parts</span>
                </a>

                <!-- Services -->
                <a href="{{ route('services.index') }}" 
                   class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('services.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="font-medium">Services</span>
                </a>

                <!-- Invoices -->
                <a href="{{ route('invoices.index') }}" 
                   class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('invoices.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-medium">Invoices</span>
                </a>
            </nav>
        </div>

        <!-- User Info at Bottom -->
        <div class="px-4 py-4 border-t border-white/10">
            <div class="flex items-center justify-between px-4 py-3 bg-white/10 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-blue-200 text-xs">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white hover:text-red-300 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu Button -->
<button @click="open = true" class="lg:hidden fixed top-4 left-4 z-40 p-2 bg-[#01205C] text-white rounded-lg shadow-lg">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- Overlay for mobile -->
<div x-show="open" @click="open = false" class="lg:hidden fixed inset-0 bg-black/50 z-40" style="display: none;"></div>

</div>
