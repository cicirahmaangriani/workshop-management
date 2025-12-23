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
                    Mulai Kelola Bengkel Anda dengan Lebih Efisien
                </h2>
                
                <p class="text-blue-100 text-lg mb-8">
                    Bergabunglah dengan 500+ bengkel yang sudah menggunakan WorkshopPro untuk meningkatkan produktivitas hingga 300%.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span>Gratis 30 hari trial</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span>Tanpa perlu kartu kredit</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span>Support 24/7</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-[#01205C] mb-2">Buat Akun Baru</h2>
                        <p class="text-gray-600">Isi data di bawah untuk mendaftar</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3273BA] focus:border-transparent transition"
                                    placeholder="John Doe">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

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
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3273BA] focus:border-transparent transition"
                                    placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#01205C] to-[#3273BA] text-white py-3 rounded-lg font-semibold hover:opacity-90 transition duration-200 shadow-lg">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-[#3273BA] font-semibold hover:underline">
                                Masuk di sini
                            </a>
                        </p>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-xs text-gray-500 text-center">
                            Dengan mendaftar, Anda menyetujui 
                            <a href="#" class="text-[#3273BA] hover:underline">Syarat & Ketentuan</a> 
                            dan 
                            <a href="#" class="text-[#3273BA] hover:underline">Kebijakan Privasi</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
