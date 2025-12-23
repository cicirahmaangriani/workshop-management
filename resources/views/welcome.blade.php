<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Workshop Management System - Solusi Terpadu Bengkel Anda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <style>
        :root {
            --navy: #01205C;
            --blue: #3273BA;
            --light: #FAFFEF;
            --soft-blue: #E1EBF7;
            --ice: #F5FAFF;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(50px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @keyframes scaleIn {
            from { 
                opacity: 0; 
                transform: scale(0.9); 
            }
            to { 
                opacity: 1; 
                transform: scale(1); 
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-reveal-scale {
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.8s ease-out;
        }

        .scroll-reveal-scale.active {
            opacity: 1;
            transform: scale(1);
        }

        .stat-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-10px) scale(1.05);
        }

        .feature-card {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(50, 115, 186, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(1, 32, 92, 0.15);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, var(--blue), var(--navy));
        }

        .feature-icon {
            transition: all 0.4s ease;
        }

        .testimonial-card {
            transition: all 0.4s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 35px rgba(1, 32, 92, 0.2);
        }

        .pricing-card {
            transition: all 0.4s ease;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(1, 32, 92, 0.2);
        }

        .benefit-card {
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .benefit-card:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.2);
        }

        .dashboard-preview {
            transition: all 0.5s ease;
        }

        .dashboard-preview:hover {
            transform: scale(1.02) rotate(-1deg);
        }

        /* Image hover effect */
        .image-container {
            overflow: hidden;
            border-radius: 1.5rem;
        }

        .image-container img {
            transition: all 0.5s ease;
        }

        .image-container:hover img {
            transform: scale(1.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Intersection Observer for scroll animations
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                            // Unobserve after animation to prevent reprocessing
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                // Observe all scroll-reveal elements
                const elements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-scale');
                elements.forEach(el => {
                    if (el) {
                        observer.observe(el);
                    }
                });

                // Staggered animation for cards
                const staggerItems = document.querySelectorAll('.stagger-item');
                staggerItems.forEach((el, index) => {
                    if (el && index < 20) { // Limit to prevent infinite loops
                        el.style.transitionDelay = `${index * 0.1}s`;
                    }
                });
            } catch (error) {
                console.error('Animation initialization error:', error);
            }
        });
    </script>
</head>
<body class="bg-gradient-to-br from-[var(--light)] to-[var(--ice)] text-[var(--navy)]">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-md sticky top-0 z-50">
        <div class="flex items-center justify-between max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-[var(--navy)] rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <div class="text-2xl font-bold tracking-wide">
                    Workshop<span class="text-[var(--blue)]">Pro</span>
                </div>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#features" class="text-gray-700 hover:text-[var(--blue)] transition">Fitur</a>
                <a href="#benefits" class="text-gray-700 hover:text-[var(--blue)] transition">Keunggulan</a>
                <a href="#testimonials" class="text-gray-700 hover:text-[var(--blue)] transition">Testimoni</a>
                <a href="#pricing" class="text-gray-700 hover:text-[var(--blue)] transition">Harga</a>
            </div>
            <div class="space-x-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="px-5 py-2 border-2 border-[var(--navy)] rounded-full hover:bg-[var(--navy)] hover:text-white transition font-medium">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-[var(--navy)] text-white rounded-full hover:bg-[var(--blue)] transition font-medium shadow-lg">
                        Daftar Gratis
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-16 items-center">
        <div class="animate-fade-in">
            <div class="inline-block px-4 py-2 bg-[var(--blue)]/10 text-[var(--blue)] rounded-full mb-6 font-medium">
                 Solusi Bengkel Modern #1 di Indonesia
            </div>
            <h1 class="text-6xl font-bold leading-tight">
                Kelola Bengkel Anda dengan
                <span class="text-[var(--blue)]">Lebih Efisien</span>
            </h1>
            <p class="mt-6 text-xl text-gray-700 leading-relaxed">
                Sistem manajemen workshop terintegrasi untuk mengelola servis, spare parts, mekanik, dan pelanggan. 
                Tingkatkan produktivitas bengkel hingga <span class="font-bold text-[var(--blue)]">300%</span>.
            </p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('register') }}"
                   class="px-8 py-4 bg-[var(--navy)] text-white rounded-full hover:bg-[var(--blue)] transition font-semibold shadow-xl hover:shadow-2xl">
                    Mulai Gratis Sekarang →
                </a>
                <a href="#demo"
                   class="px-8 py-4 border-2 border-[var(--navy)] rounded-full hover:bg-[var(--navy)] hover:text-white transition font-semibold">
                    Lihat Demo
                </a>
            </div>
            <div class="mt-10 flex items-center space-x-8 text-sm text-gray-600">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Gratis 30 hari</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Tanpa kartu kredit</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Support 24/7</span>
                </div>
            </div>
        </div>

        <!-- Dashboard Preview with Image -->
        <div class="relative animate-fade-in">
            <div class="absolute inset-0 bg-gradient-to-tr from-[var(--blue)]/20 to-[var(--navy)]/20 rounded-3xl transform rotate-3"></div>
            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl dashboard-preview">
                <!-- Workshop Illustration -->
                <div class="image-container bg-gradient-to-br from-[var(--blue)] to-[var(--navy)] p-8">
                    <div class="text-center text-white">
                        <svg class="w-full h-48 mx-auto" viewBox="0 0 800 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Car -->
                            <rect x="150" y="180" width="200" height="80" rx="10" fill="white" opacity="0.9"/>
                            <rect x="160" y="200" width="50" height="40" rx="5" fill="rgba(50, 115, 186, 0.5)"/>
                            <rect x="280" y="200" width="50" height="40" rx="5" fill="rgba(50, 115, 186, 0.5)"/>
                            <circle cx="190" cy="270" r="25" fill="rgba(1, 32, 92, 0.8)"/>
                            <circle cx="190" cy="270" r="15" fill="white" opacity="0.5"/>
                            <circle cx="310" cy="270" r="25" fill="rgba(1, 32, 92, 0.8)"/>
                            <circle cx="310" cy="270" r="15" fill="white" opacity="0.5"/>
                            
                            <!-- Tools -->
                            <path d="M450 200 L480 230 L470 240 L440 210 Z" fill="white" opacity="0.8"/>
                            <circle cx="500" cy="220" r="20" fill="white" opacity="0.8"/>
                            <rect x="520" y="210" width="60" height="10" rx="5" fill="white" opacity="0.8"/>
                            
                            <!-- Mechanic Figure -->
                            <circle cx="600" cy="190" r="20" fill="white" opacity="0.9"/>
                            <rect x="580" y="210" width="40" height="60" rx="5" fill="white" opacity="0.9"/>
                            
                            <!-- Dashboard Elements -->
                            <rect x="50" y="100" width="120" height="60" rx="8" fill="white" opacity="0.7"/>
                            <rect x="60" y="110" width="100" height="8" rx="4" fill="rgba(50, 115, 186, 0.6)"/>
                            <rect x="60" y="130" width="80" height="6" rx="3" fill="rgba(50, 115, 186, 0.4)"/>
                            <rect x="60" y="145" width="60" height="6" rx="3" fill="rgba(50, 115, 186, 0.4)"/>
                        </svg>
                    </div>
                </div>
                <div class="p-8">
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                    <div class="space-y-4">
                        <div class="h-12 bg-gradient-to-r from-[var(--navy)] to-[var(--blue)] rounded-lg flex items-center px-4 text-white font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Dashboard Analytics
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="h-24 bg-[var(--soft-blue)] rounded-lg p-3 flex flex-col justify-between">
                                <div class="text-2xl font-bold text-[var(--navy)]">250</div>
                                <div class="text-xs text-gray-600">Services</div>
                            </div>
                            <div class="h-24 bg-[var(--soft-blue)] rounded-lg p-3 flex flex-col justify-between">
                                <div class="text-2xl font-bold text-[var(--navy)]">180</div>
                                <div class="text-xs text-gray-600">Vehicles</div>
                            </div>
                            <div class="h-24 bg-[var(--soft-blue)] rounded-lg p-3 flex flex-col justify-between">
                                <div class="text-2xl font-bold text-[var(--navy)]">95%</div>
                                <div class="text-xs text-gray-600">Rating</div>
                            </div>
                        </div>
                        <div class="h-32 bg-[var(--ice)] rounded-lg p-4">
                            <div class="flex justify-between items-end h-full">
                                <div class="w-8 bg-[var(--blue)] rounded-t" style="height: 60%"></div>
                                <div class="w-8 bg-[var(--blue)] rounded-t" style="height: 80%"></div>
                                <div class="w-8 bg-[var(--blue)] rounded-t" style="height: 45%"></div>
                                <div class="w-8 bg-[var(--blue)] rounded-t" style="height: 90%"></div>
                                <div class="w-8 bg-[var(--navy)] rounded-t" style="height: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-[var(--navy)] text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="stat-card scroll-reveal stagger-item">
                    <div class="text-5xl font-bold text-[var(--blue)] mb-2">500+</div>
                    <div class="text-lg">Bengkel Terdaftar</div>
                    <div class="mt-3 text-blue-300 text-sm">🏢 Workshop</div>
                </div>
                <div class="stat-card scroll-reveal stagger-item">
                    <div class="text-5xl font-bold text-[var(--blue)] mb-2">10K+</div>
                    <div class="text-lg">Kendaraan Dikelola</div>
                    <div class="mt-3 text-blue-300 text-sm">🚗 Vehicles</div>
                </div>
                <div class="stat-card scroll-reveal stagger-item">
                    <div class="text-5xl font-bold text-[var(--blue)] mb-2">50K+</div>
                    <div class="text-lg">Service Selesai</div>
                    <div class="mt-3 text-blue-300 text-sm">✅ Completed</div>
                </div>
                <div class="stat-card scroll-reveal stagger-item">
                    <div class="text-5xl font-bold text-[var(--blue)] mb-2">99%</div>
                    <div class="text-lg">Kepuasan Pelanggan</div>
                    <div class="mt-3 text-blue-300 text-sm">⭐ Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold text-[var(--navy)] mb-4">
                    Fitur Lengkap untuk Bengkel Modern
                </h2>
                <p class="text-xl text-gray-600">
                    Semua yang Anda butuhkan untuk mengelola workshop dalam satu platform
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="feature-icon w-14 h-14 bg-[var(--blue)]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[var(--blue)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--navy)] mb-3">Manajemen Kendaraan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Catat data lengkap kendaraan pelanggan termasuk merek, model, nomor plat, dan riwayat service lengkap dari awal hingga sekarang.
                    </p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="feature-icon w-14 h-14 bg-[var(--blue)]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[var(--blue)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--navy)] mb-3">Tracking Service Real-time</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau progres service dari pending, in-progress, hingga completed. Pelanggan dapat melihat status kendaraannya kapan saja.
                    </p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="feature-icon w-14 h-14 bg-[var(--blue)]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[var(--blue)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--navy)] mb-3">Inventori Spare Parts</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kelola stok spare parts dengan sistem yang terintegrasi. Notifikasi otomatis ketika stok menipis dan laporan pembelian lengkap.
                    </p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="feature-icon w-14 h-14 bg-[var(--blue)]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[var(--blue)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--navy)] mb-3">Manajemen Mekanik</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Data lengkap mekanik, keahlian, sertifikasi, dan tracking performa. Assign pekerjaan berdasarkan spesialisasi dan workload.
                    </p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="feature-icon w-14 h-14 bg-[var(--blue)]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[var(--blue)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--navy)] mb-3">Invoice & Pembayaran</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Generate invoice otomatis dengan detail biaya service dan spare parts. Catat riwayat pembayaran dan metode pembayaran yang digunakan.
                    </p>
                </div>

                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="feature-icon w-14 h-14 bg-[var(--blue)]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[var(--blue)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--navy)] mb-3">Laporan & Analitik</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dashboard analitik lengkap dengan grafik revenue, service terbanyak, spare parts terlaris, dan performa mekanik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="bg-gradient-to-br from-[var(--navy)] to-[var(--blue)] text-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold mb-4">
                    Mengapa Memilih WorkshopPro?
                </h2>
                <p class="text-xl text-blue-100">
                    Solusi terbaik yang sudah terbukti meningkatkan efisiensi bengkel
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="benefit-card bg-white/10 backdrop-blur-md p-8 rounded-2xl scroll-reveal stagger-item">
                    <div class="flex items-start space-x-4">
                        <div class="text-4xl">⚡</div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">Hemat Waktu hingga 70%</h3>
                            <p class="text-blue-100">
                                Otomasi proses administrasi, dari pencatatan service, pengelolaan stok, hingga pembuatan invoice. Fokus pada pekerjaan yang lebih penting.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="benefit-card bg-white/10 backdrop-blur-md p-8 rounded-2xl scroll-reveal stagger-item">
                    <div class="flex items-start space-x-4">
                        <div class="text-4xl">📈</div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">Tingkatkan Revenue</h3>
                            <p class="text-blue-100">
                                Dengan tracking yang lebih baik, tidak ada service atau spare parts yang terlewat dicatat. Maksimalkan profit bengkel Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="benefit-card bg-white/10 backdrop-blur-md p-8 rounded-2xl scroll-reveal stagger-item">
                    <div class="flex items-start space-x-4">
                        <div class="text-4xl">🔒</div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">Keamanan Data Terjamin</h3>
                            <p class="text-blue-100">
                                Data tersimpan aman di cloud dengan enkripsi tingkat enterprise. Backup otomatis setiap hari untuk mencegah kehilangan data.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="benefit-card bg-white/10 backdrop-blur-md p-8 rounded-2xl scroll-reveal stagger-item">
                    <div class="flex items-start space-x-4">
                        <div class="text-4xl">📱</div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">Akses Dimana Saja</h3>
                            <p class="text-blue-100">
                                Interface responsive yang dapat diakses dari komputer, tablet, atau smartphone. Kelola bengkel dari mana saja, kapan saja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold text-[var(--navy)] mb-4">
                    Dipercaya oleh Bengkel Terbaik
                </h2>
                <p class="text-xl text-gray-600">
                    Dengar langsung dari pemilik bengkel yang sudah merasakan manfaatnya
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3273BA&color=fff&size=48" 
                             alt="Budi Santoso" 
                             class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-[var(--navy)]">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Owner Bengkel Sejahtera</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-4 text-xl">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-600 italic">
                        "Sejak pakai WorkshopPro, administrasi bengkel jadi lebih rapi. Pelanggan juga puas karena bisa tracking service mereka. Recommended!"
                    </p>
                </div>

                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=01205C&color=fff&size=48" 
                             alt="Siti Nurhaliza" 
                             class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-[var(--navy)]">Siti Nurhaliza</h4>
                            <p class="text-sm text-gray-600">Owner Auto Service Center</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-4 text-xl">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-600 italic">
                        "Manajemen spare parts jadi lebih mudah. Tidak ada lagi stok yang tiba-tiba habis tanpa diketahui. Revenue meningkat 40%!"
                    </p>
                </div>

                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=3273BA&color=fff&size=48" 
                             alt="Ahmad Fauzi" 
                             class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-[var(--navy)]">Ahmad Fauzi</h4>
                            <p class="text-sm text-gray-600">Manager Bengkel Premium</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-4 text-xl">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-600 italic">
                        "Interface-nya mudah dipahami, bahkan mekanik senior yang tidak terlalu paham teknologi bisa langsung menggunakannya."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="bg-[var(--ice)] py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold text-[var(--navy)] mb-4">
                    Harga Terjangkau untuk Semua Bengkel
                </h2>
                <p class="text-xl text-gray-600">
                    Pilih paket yang sesuai dengan kebutuhan bengkel Anda
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="pricing-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <h3 class="text-2xl font-bold text-[var(--navy)] mb-2">Starter</h3>
                    <div class="text-4xl font-bold text-[var(--blue)] mb-4">Gratis</div>
                    <p class="text-gray-600 mb-6">Untuk bengkel kecil yang baru memulai</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Hingga 50 kendaraan</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>2 pengguna</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Fitur dasar</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center px-6 py-3 border-2 border-[var(--navy)] rounded-full hover:bg-[var(--navy)] hover:text-white transition font-semibold">
                        Mulai Gratis
                    </a>
                </div>

                <div class="pricing-card bg-gradient-to-br from-[var(--navy)] to-[var(--blue)] p-8 rounded-2xl shadow-2xl transform md:scale-105 scroll-reveal-scale stagger-item">
                    <div class="text-center mb-4">
                        <span class="px-4 py-1 bg-yellow-400 text-[var(--navy)] rounded-full text-sm font-bold">⭐ PALING POPULER</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Professional</h3>
                    <div class="text-4xl font-bold text-white mb-1">Rp 299K</div>
                    <p class="text-blue-100 mb-6">/bulan</p>
                    <p class="text-blue-100 mb-6">Untuk bengkel yang sedang berkembang</p>
                    <ul class="space-y-3 mb-8 text-white">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Kendaraan unlimited</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>10 pengguna</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Semua fitur lengkap</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Laporan analitik</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Priority support</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center px-6 py-3 bg-white text-[var(--navy)] rounded-full hover:bg-gray-100 transition font-semibold">
                        Coba Gratis 30 Hari
                    </a>
                </div>

                <div class="pricing-card bg-white p-8 rounded-2xl shadow-lg scroll-reveal stagger-item">
                    <h3 class="text-2xl font-bold text-[var(--navy)] mb-2">Enterprise</h3>
                    <div class="text-4xl font-bold text-[var(--blue)] mb-4">Custom</div>
                    <p class="text-gray-600 mb-6">Untuk jaringan bengkel besar</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Multiple locations</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Unlimited users</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Custom features</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Dedicated support</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block text-center px-6 py-3 border-2 border-[var(--navy)] rounded-full hover:bg-[var(--navy)] hover:text-white transition font-semibold">
                        Hubungi Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-[var(--navy)] to-[var(--blue)] text-white overflow-hidden relative">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-32 translate-y-32"></div>
        
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 scroll-reveal">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Membawa Bengkel Anda ke Level Berikutnya?
            </h2>
            <p class="text-xl mb-8 text-blue-100">
                Bergabunglah dengan ratusan bengkel yang sudah meningkatkan efisiensi dan revenue mereka
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}"
                   class="px-10 py-4 bg-white text-[var(--navy)] rounded-full hover:bg-gray-100 transition font-bold text-lg shadow-2xl hover:shadow-3xl hover:scale-105 transform">
                    Daftar Gratis Sekarang
                </a>
                <a href="#demo"
                   class="px-10 py-4 border-2 border-white rounded-full hover:bg-white hover:text-[var(--navy)] transition font-bold text-lg">
                    Jadwalkan Demo
                </a>
            </div>
            <p class="mt-6 text-sm text-blue-200">
                ✓ Gratis 30 hari ✓ Tanpa kartu kredit ✓ Batal kapan saja
            </p>
            
            <!-- Trust badges -->
            <div class="mt-12 flex flex-wrap justify-center items-center gap-8 text-blue-200">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">SSL Secured</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                    <span class="font-medium">99.9% Uptime</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">24/7 Support</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[var(--navy)] text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-[var(--navy)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">WorkshopPro</span>
                    </div>
                    <p class="text-blue-200 text-sm">
                        Solusi manajemen workshop terlengkap dan terpercaya di Indonesia.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Produk</h4>
                    <ul class="space-y-2 text-blue-200 text-sm">
                        <li><a href="#features" class="hover:text-white transition">Fitur</a></li>
                        <li><a href="#pricing" class="hover:text-white transition">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition">Demo</a></li>
                        <li><a href="#" class="hover:text-white transition">API</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-blue-200 text-sm">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Dukungan</h4>
                    <ul class="space-y-2 text-blue-200 text-sm">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Status</a></li>
                        <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-blue-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-blue-200">
                    © {{ date('Y') }} WorkshopPro. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-blue-200 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-blue-200 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-blue-200 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121L7.773 13.78l-2.9-.906c-.63-.196-.642-.63.135-.93l11.315-4.365c.527-.196.985.126.815.93z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
