<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Service;
use App\Models\Invoice;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalCustomers = Customer::count();
        $totalVehicles = Vehicle::count();
        $totalServices = Service::count();
        
        // Revenue Statistics
        $totalRevenue = Invoice::where('payment_status', 'paid')->sum('total');
        $pendingRevenue = Invoice::where('payment_status', '!=', 'paid')->sum('total');
        
        // Service Statistics
        $pendingServices = Service::where('status', 'pending')->count();
        $inProgressServices = Service::where('status', 'in_progress')->count();
        $completedServices = Service::where('status', 'completed')->count();
        
        // Recent Services
        $recentServices = Service::with(['vehicle.customer', 'mechanic'])
            ->latest()
            ->limit(5)
            ->get();
            
        // Low Stock Spare Parts
        $lowStockParts = SparePart::lowStock()
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();
            
        // Unpaid Invoices
        $unpaidInvoices = Invoice::with('service.vehicle.customer')
            ->where('payment_status', '!=', 'paid')
            ->latest()
            ->limit(5)
            ->get();
            
        // Monthly Revenue Chart (Last 6 months)
        $monthlyRevenue = Invoice::select(
                DB::raw('YEAR(invoice_date) as year'),
                DB::raw('MONTH(invoice_date) as month'),
                DB::raw('SUM(total) as total')
            )
            ->where('payment_status', 'paid')
            ->where('invoice_date', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'totalVehicles',
            'totalServices',
            'totalRevenue',
            'pendingRevenue',
            'pendingServices',
            'inProgressServices',
            'completedServices',
            'recentServices',
            'lowStockParts',
            'unpaidInvoices',
            'monthlyRevenue'
        ));
    }
}