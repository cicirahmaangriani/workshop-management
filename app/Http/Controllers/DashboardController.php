<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\SparePart;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalCustomers = Customer::count();
        $completedServices = Service::where('status', 'completed')->count();
        $pendingServices = Service::whereIn('status', ['pending', 'in_progress'])->count();
        
        // Total revenue from PAID invoices only
        $totalRevenue = Invoice::where('payment_status', 'paid')->sum('total');

        // Recent services (last 5)
        $recentServices = Service::with(['vehicle.customer', 'mechanic'])
            ->latest()
            ->take(5)
            ->get();

        // Low stock parts (stock <= 10)
        $lowStockParts = SparePart::where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Unpaid invoices
        $unpaidInvoices = Invoice::with(['service.vehicle.customer'])
            ->whereIn('payment_status', ['unpaid', 'partial'])
            ->latest()
            ->take(5)
            ->get();

        // Monthly revenue - Check invoices first, fallback to completed services
        $monthlyRevenue = DB::table('invoices')
            ->select(
                DB::raw('YEAR(invoice_date) as year'),
                DB::raw('MONTH(invoice_date) as month'),
                DB::raw('SUM(CASE 
                    WHEN payment_status = "paid" THEN total
                    WHEN payment_status = "partial" THEN paid
                    ELSE 0 
                END) as total')
            )
            ->where('invoice_date', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function($item) {
                return [
                    'year' => (int)$item->year,
                    'month' => (int)$item->month,
                    'total' => (float)$item->total
                ];
            });

        // If no invoice data, use completed services as fallback
        if ($monthlyRevenue->isEmpty()) {
            $monthlyRevenue = DB::table('services')
                ->select(
                    DB::raw('YEAR(service_date) as year'),
                    DB::raw('MONTH(service_date) as month'),
                    DB::raw('SUM(IFNULL(labor_cost, 0)) as labor_total'),
                    DB::raw('COUNT(*) as service_count')
                )
                ->where('status', 'completed')
                ->where('service_date', '>=', now()->subMonths(6)->startOfMonth())
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

            // Calculate total including parts cost for each month
            $monthlyRevenue = $monthlyRevenue->map(function($item) {
                // Get services for this month
                $services = Service::whereYear('service_date', $item->year)
                    ->whereMonth('service_date', $item->month)
                    ->where('status', 'completed')
                    ->get();
                
                // Calculate total including parts
                $total = $services->sum(function($service) {
                    return $service->labor_cost + $service->parts_cost;
                });
                
                return [
                    'year' => (int)$item->year,
                    'month' => (int)$item->month,
                    'total' => (float)$total
                ];
            });
        }

        // Debug log
        \Log::info('Dashboard Monthly Revenue', [
            'count' => $monthlyRevenue->count(),
            'data' => $monthlyRevenue->toArray(),
            'date_filter' => now()->subMonths(6)->startOfMonth()->format('Y-m-d')
        ]);

        // If no data, create last 6 months placeholder
        if ($monthlyRevenue->isEmpty()) {
            $monthlyRevenue = collect();
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthlyRevenue->push((object)[
                    'year' => (int)$date->year,
                    'month' => (int)$date->month,
                    'total' => 0
                ]);
            }
        }

        return view('dashboard', compact(
            'totalCustomers',
            'completedServices',
            'pendingServices',
            'totalRevenue',
            'recentServices',
            'lowStockParts',
            'unpaidInvoices',
            'monthlyRevenue'
        ));
    }
}