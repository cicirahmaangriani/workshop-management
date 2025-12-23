<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Left Side - Illustration -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#01205C] to-[#3273BA] p-12 items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-20 w-72 h-72 bg-white rounded-full"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-white rounded-full"></div>
            </div>
            
            <div class="relative z-10 text-white max-w-md">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#01205C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold">WorkshopPro</h1>
                </div>
                
                <h2 class="text-4xl font-bold mb-6 leading-tight">
                    Selamat Datang Kembali!
                </h2>
                
                <p class="text-blue-100 text-lg mb-8">
                    Masuk ke akun Anda dan lanjutkan mengelola bengkel dengan lebih efisien bersama WorkshopPro.
                </p>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 space-y-4 transition-all duration-300 hover:bg-white/20 hover:scale-[1.02]">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Kelola Service</h3>
                            <p class="text-sm text-blue-100">Track semua service dari pending hingga selesai</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Manage Spare Parts</h3>
                            <p class="text-sm text-blue-100">Inventori dan stok spare parts terintegrasi</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Laporan Lengkap</h3>
                            <p class="text-sm text-blue-100">Analytics dan insights untuk bisnis Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center justify-center space-x-2 mb-8">
                        <div class="w-10 h-10 bg-[#01205C] rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-[#01205C]">WorkshopPro</h1>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-[#01205C] mb-2">Masuk</h2>
                        <p class="text-gray-600">Selamat datang kembali! Silakan masuk ke akun Anda</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3273BA] focus:border-transparent transition"
                                    placeholder="john@example.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3273BA] focus:border-transparent transition"
                                    placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center">
                                <input id="remember_me" type="checkbox" 
                                    class="rounded border-gray-300 text-[#3273BA] shadow-sm focus:ring-[#3273BA]" 
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                    class="text-sm text-[#3273BA] font-semibold hover:underline">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#01205C] to-[#3273BA] text-white py-3 rounded-lg font-semibold hover:opacity-90 transition duration-200 shadow-lg">
                            Masuk
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-[#3273BA] font-semibold hover:underline">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                            <a href="#" class="hover:text-[#3273BA]">Bantuan</a>
                            <span>•</span>
                            <a href="#" class="hover:text-[#3273BA]">Privasi</a>
                            <span>•</span>
                            <a href="#" class="hover:text-[#3273BA]">Syarat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
