<x-app-layout>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Customers Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Customers</p>
                    <p class="text-4xl font-bold">{{ $totalCustomers }}</p>
                    <p class="text-blue-100 text-xs mt-2">+12% dari bulan lalu</p>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Services Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Completed Services</p>
                    <p class="text-4xl font-bold">{{ $completedServices }}</p>
                    <p class="text-green-100 text-xs mt-2">+8% dari bulan lalu</p>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Services Card -->
        <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium mb-1">Pending Services</p>
                    <p class="text-4xl font-bold">{{ $pendingServices }}</p>
                    <p class="text-yellow-100 text-xs mt-2">Perlu ditangani</p>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div class="w-full">
                    <p class="text-purple-100 text-sm font-medium mb-1">Total Revenue</p>
                    <p class="text-4xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-purple-100 text-xs mt-2">Total pendapatan terbayar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Services & Low Stock -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Services -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Recent Services</h3>
                <a href="{{ route('services.index') }}" class="text-sm text-[#3273BA] font-semibold flex items-center">
                    View All 
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentServices as $service)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#01205C] to-[#3273BA] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $service->service_number }}</p>
                                <p class="text-sm text-gray-600">{{ $service->vehicle->customer->name }}</p>
                                <p class="text-xs text-gray-500">{{ $service->vehicle->license_plate }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            @if($service->status == 'completed') bg-green-100 text-green-700
                            @elseif($service->status == 'in_progress') bg-blue-100 text-blue-700
                            @else bg-yellow-100 text-yellow-700
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $service->status)) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-500">No recent services</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Parts -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Low Stock Alert</h3>
                <a href="{{ route('spare-parts.index') }}" class="text-sm text-[#3273BA] font-semibold flex items-center">
                    View All 
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="space-y-4">
                @forelse($lowStockParts as $part)
                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border border-red-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $part->name }}</p>
                                <p class="text-sm text-gray-600">Code: {{ $part->code }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-red-600">{{ $part->stock }}</p>
                            <p class="text-xs text-red-500">units left</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-500">All parts are well stocked</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Unpaid Invoices -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Unpaid Invoices</h3>
            <a href="{{ route('invoices.index') }}" class="text-sm text-[#3273BA] hover:text-[#01205C] font-semibold flex items-center">
                View All 
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($unpaidInvoices as $invoice)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-900">{{ $invoice->invoice_number }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-900 font-medium">{{ $invoice->service->vehicle->customer->name }}</p>
                                <p class="text-xs text-gray-500">{{ $invoice->service->vehicle->license_plate }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-bold text-gray-900">Rp {{ number_format($invoice->total, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($invoice->payment_status == 'unpaid') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ ucfirst($invoice->payment_status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 font-medium">No unpaid invoices</p>
                                <p class="text-gray-400 text-sm">All invoices are up to date</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Monthly Revenue Chart -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Monthly Revenue Trend</h3>
                <p class="text-sm text-gray-500 mt-1">Last 6 months performance</p>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                <span class="text-sm text-gray-600">Revenue (Million Rp)</span>
            </div>
        </div>
        <div class="relative h-64">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Wait for DOM and Chart.js to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Revenue Chart
        const ctx = document.getElementById('revenueChart');
        if (!ctx) {
            console.error('Canvas element not found');
            return;
        }
        
        const monthlyData = @json($monthlyRevenue);
        console.log('Monthly data:', monthlyData);
        
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        // Handle empty data
        let labels, data;
        if (monthlyData && monthlyData.length > 0) {
            labels = monthlyData.map(item => months[item.month - 1] + ' ' + item.year);
            data = monthlyData.map(item => item.total / 1000000);
        } else {
            // Show placeholder data if no data available
            const now = new Date();
            labels = [];
            data = [];
            for (let i = 5; i >= 0; i--) {
                const date = new Date(now.getFullYear(), now.getMonth() - i, 1);
                labels.push(months[date.getMonth()] + ' ' + date.getFullYear());
                data.push(0);
            }
        }
        
        new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue (Million Rp)',
                data: data,
                borderColor: '#3273BA',
                backgroundColor: 'rgba(50, 115, 186, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#3273BA',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#01205C',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toFixed(2) + 'M';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value + 'M';
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
            }
        });
        
        console.log('Chart initialized successfully');
    });

    // Auto-refresh dashboard data every 30 seconds
    let refreshInterval;
    
    function startAutoRefresh() {
        refreshInterval = setInterval(() => {
            // Reload page to get fresh data
            location.reload();
        }, 30000); // 30 seconds
    }
    
    // Start auto-refresh
    startAutoRefresh();
    
    // Show last updated time
    const now = new Date();
    console.log('Dashboard updated at:', now.toLocaleTimeString());
</script>
@endpush