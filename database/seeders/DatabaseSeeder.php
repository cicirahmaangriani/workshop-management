<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Mechanic;
use App\Models\SparePart;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@workshop.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Create Receptionist User
        User::firstOrCreate(
            ['email' => 'receptionist@workshop.com'],
            [
                'name' => 'Receptionist User',
                'password' => bcrypt('password'),
                'role' => 'receptionist',
            ]
        );

        // Create Mechanic User
        User::firstOrCreate(
            ['email' => 'mechanic@workshop.com'],
            [
                'name' => 'Mechanic User',
                'password' => bcrypt('password'),
                'role' => 'mechanic',
            ]
        );

        // Create Sample Customers
        $customers = [
            [
                'name' => 'John Doe',
                'phone' => '08123456789',
                'email' => 'john@example.com',
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
            ],
            [
                'name' => 'Jane Smith',
                'phone' => '08234567890',
                'email' => 'jane@example.com',
                'address' => 'Jl. Sudirman No. 456, Bandung',
            ],
            [
                'name' => 'Bob Johnson',
                'phone' => '08345678901',
                'email' => 'bob@example.com',
                'address' => 'Jl. Thamrin No. 789, Surabaya',
            ],
            [
                'name' => 'Alice Williams',
                'phone' => '08456789012',
                'email' => 'alice@example.com',
                'address' => 'Jl. Diponegoro No. 321, Semarang',
            ],
            [
                'name' => 'Charlie Brown',
                'phone' => '08567890123',
                'email' => 'charlie@example.com',
                'address' => 'Jl. Ahmad Yani No. 654, Yogyakarta',
            ],
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }

        // Create Sample Vehicles
        $vehicles = [
            ['customer_id' => 1, 'license_plate' => 'B 1234 ABC', 'brand' => 'Toyota', 'model' => 'Avanza', 'year' => 2020, 'color' => 'Silver', 'chassis_number' => 'MHFM123456789', 'engine_number' => 'G16E123456'],
            ['customer_id' => 1, 'license_plate' => 'B 5678 DEF', 'brand' => 'Honda', 'model' => 'CR-V', 'year' => 2021, 'color' => 'White'],
            ['customer_id' => 2, 'license_plate' => 'D 1111 XYZ', 'brand' => 'Honda', 'model' => 'Jazz', 'year' => 2019, 'color' => 'Red'],
            ['customer_id' => 3, 'license_plate' => 'L 2222 GHI', 'brand' => 'Suzuki', 'model' => 'Ertiga', 'year' => 2022, 'color' => 'Black'],
            ['customer_id' => 4, 'license_plate' => 'H 3333 JKL', 'brand' => 'Daihatsu', 'model' => 'Xenia', 'year' => 2018, 'color' => 'Blue'],
            ['customer_id' => 5, 'license_plate' => 'AB 4444 MNO', 'brand' => 'Mitsubishi', 'model' => 'Pajero', 'year' => 2023, 'color' => 'Grey'],
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::create($vehicleData);
        }

        // Create Sample Mechanics
        $mechanics = [
            [
                'name' => 'Budi Santoso',
                'phone' => '08111222333',
                'email' => 'budi@workshop.com',
                'address' => 'Jl. Mechanic Street No. 1',
                'specialization' => 'Engine Specialist',
                'status' => 'active',
            ],
            [
                'name' => 'Ahmad Rizki',
                'phone' => '08222333444',
                'email' => 'ahmad@workshop.com',
                'address' => 'Jl. Mechanic Street No. 2',
                'specialization' => 'Electrical System',
                'status' => 'active',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'phone' => '08333444555',
                'email' => 'siti@workshop.com',
                'address' => 'Jl. Mechanic Street No. 3',
                'specialization' => 'Brake & Suspension',
                'status' => 'active',
            ],
            [
                'name' => 'Doni Prasetyo',
                'phone' => '08444555666',
                'email' => 'doni@workshop.com',
                'address' => 'Jl. Mechanic Street No. 4',
                'specialization' => 'Transmission',
                'status' => 'active',
            ],
        ];

        foreach ($mechanics as $mechanicData) {
            Mechanic::create($mechanicData);
        }

        // Create Sample Spare Parts
        $spareParts = [
            ['code' => 'SP001', 'name' => 'Engine Oil 10W-40', 'category' => 'Oil & Lubricants', 'description' => 'High quality synthetic engine oil', 'purchase_price' => 50000, 'selling_price' => 75000, 'stock' => 100, 'min_stock' => 20],
            ['code' => 'SP002', 'name' => 'Oil Filter', 'category' => 'Filter', 'description' => 'Universal oil filter', 'purchase_price' => 30000, 'selling_price' => 45000, 'stock' => 80, 'min_stock' => 15],
            ['code' => 'SP003', 'name' => 'Air Filter', 'category' => 'Filter', 'description' => 'High flow air filter', 'purchase_price' => 40000, 'selling_price' => 60000, 'stock' => 60, 'min_stock' => 15],
            ['code' => 'SP004', 'name' => 'Brake Pad Front', 'category' => 'Brake System', 'description' => 'Ceramic brake pad', 'purchase_price' => 150000, 'selling_price' => 225000, 'stock' => 40, 'min_stock' => 10],
            ['code' => 'SP005', 'name' => 'Brake Pad Rear', 'category' => 'Brake System', 'description' => 'Ceramic brake pad', 'purchase_price' => 120000, 'selling_price' => 180000, 'stock' => 35, 'min_stock' => 10],
            ['code' => 'SP006', 'name' => 'Spark Plug', 'category' => 'Engine Parts', 'description' => 'Iridium spark plug', 'purchase_price' => 25000, 'selling_price' => 40000, 'stock' => 50, 'min_stock' => 20],
            ['code' => 'SP007', 'name' => 'Battery 12V 45Ah', 'category' => 'Electrical', 'description' => 'Maintenance free battery', 'purchase_price' => 400000, 'selling_price' => 600000, 'stock' => 15, 'min_stock' => 5],
            ['code' => 'SP008', 'name' => 'Battery 12V 65Ah', 'category' => 'Electrical', 'description' => 'Heavy duty battery', 'purchase_price' => 600000, 'selling_price' => 900000, 'stock' => 8, 'min_stock' => 5],
            ['code' => 'SP009', 'name' => 'Wiper Blade Set', 'category' => 'Accessories', 'description' => 'Universal wiper blade', 'purchase_price' => 35000, 'selling_price' => 55000, 'stock' => 30, 'min_stock' => 10],
            ['code' => 'SP010', 'name' => 'Radiator Coolant', 'category' => 'Fluids', 'description' => 'Premium coolant 1 liter', 'purchase_price' => 45000, 'selling_price' => 70000, 'stock' => 45, 'min_stock' => 15],
            ['code' => 'SP011', 'name' => 'Transmission Oil', 'category' => 'Oil & Lubricants', 'description' => 'ATF transmission oil', 'purchase_price' => 80000, 'selling_price' => 120000, 'stock' => 25, 'min_stock' => 10],
            ['code' => 'SP012', 'name' => 'Timing Belt', 'category' => 'Engine Parts', 'description' => 'Heavy duty timing belt', 'purchase_price' => 200000, 'selling_price' => 300000, 'stock' => 20, 'min_stock' => 8],
            ['code' => 'SP013', 'name' => 'Alternator Belt', 'category' => 'Engine Parts', 'description' => 'Rubber alternator belt', 'purchase_price' => 50000, 'selling_price' => 75000, 'stock' => 30, 'min_stock' => 10],
            ['code' => 'SP014', 'name' => 'Cabin Air Filter', 'category' => 'Filter', 'description' => 'Activated carbon filter', 'purchase_price' => 60000, 'selling_price' => 90000, 'stock' => 7, 'min_stock' => 10],
            ['code' => 'SP015', 'name' => 'Shock Absorber Front', 'category' => 'Suspension', 'description' => 'Gas filled shock absorber', 'purchase_price' => 300000, 'selling_price' => 450000, 'stock' => 12, 'min_stock' => 6],
        ];

        foreach ($spareParts as $partData) {
            SparePart::create($partData);
        }

        // Create Sample Services
        $services = [
            [
                'vehicle_id' => 1,
                'mechanic_id' => 1,
                'service_date' => now()->subDays(30),
                'complaint' => 'Oil change needed',
                'diagnosis' => 'Regular maintenance - oil change required',
                'action_taken' => 'Changed engine oil and oil filter',
                'status' => 'completed',
                'labor_cost' => 100000,
                'completion_date' => now()->subDays(30),
            ],
            [
                'vehicle_id' => 2,
                'mechanic_id' => 2,
                'service_date' => now()->subDays(25),
                'complaint' => 'Battery weak',
                'diagnosis' => 'Battery voltage low, needs replacement',
                'action_taken' => 'Replaced battery with new 12V 65Ah',
                'status' => 'completed',
                'labor_cost' => 150000,
                'completion_date' => now()->subDays(25),
            ],
            [
                'vehicle_id' => 3,
                'mechanic_id' => 3,
                'service_date' => now()->subDays(20),
                'complaint' => 'Brake noise when stopping',
                'diagnosis' => 'Front brake pads worn out',
                'action_taken' => 'Replaced front brake pads',
                'status' => 'completed',
                'labor_cost' => 200000,
                'completion_date' => now()->subDays(20),
            ],
            [
                'vehicle_id' => 4,
                'mechanic_id' => 1,
                'service_date' => now()->subDays(15),
                'complaint' => 'General service and check-up',
                'diagnosis' => 'Regular maintenance required',
                'action_taken' => 'Full service: oil change, filter replacement, general check',
                'status' => 'completed',
                'labor_cost' => 250000,
                'completion_date' => now()->subDays(15),
            ],
            [
                'vehicle_id' => 5,
                'mechanic_id' => 4,
                'service_date' => now()->subDays(10),
                'complaint' => 'Transmission problem',
                'diagnosis' => 'Transmission oil contaminated',
                'action_taken' => 'Changed transmission oil and filter',
                'status' => 'completed',
                'labor_cost' => 300000,
                'completion_date' => now()->subDays(10),
            ],
            [
                'vehicle_id' => 6,
                'mechanic_id' => 2,
                'service_date' => now()->subDays(5),
                'complaint' => 'AC not cold',
                'diagnosis' => 'Low refrigerant',
                'action_taken' => 'Refilled AC refrigerant',
                'status' => 'in_progress',
                'labor_cost' => 200000,
            ],
            [
                'vehicle_id' => 1,
                'mechanic_id' => 3,
                'service_date' => now()->subDays(2),
                'complaint' => 'Brake squeaking',
                'diagnosis' => 'Pending inspection',
                'action_taken' => null,
                'status' => 'pending',
                'labor_cost' => 150000,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }

        // Create Service Items (Spare Parts Used)
        $serviceItems = [
            ['service_id' => 1, 'spare_part_id' => 1, 'quantity' => 4, 'price' => 75000], // Engine Oil
            ['service_id' => 1, 'spare_part_id' => 2, 'quantity' => 1, 'price' => 45000], // Oil Filter
            ['service_id' => 2, 'spare_part_id' => 8, 'quantity' => 1, 'price' => 900000], // Battery 65Ah
            ['service_id' => 3, 'spare_part_id' => 4, 'quantity' => 1, 'price' => 225000], // Brake Pad Front
            ['service_id' => 4, 'spare_part_id' => 1, 'quantity' => 4, 'price' => 75000], // Engine Oil
            ['service_id' => 4, 'spare_part_id' => 2, 'quantity' => 1, 'price' => 45000], // Oil Filter
            ['service_id' => 4, 'spare_part_id' => 3, 'quantity' => 1, 'price' => 60000], // Air Filter
            ['service_id' => 4, 'spare_part_id' => 6, 'quantity' => 4, 'price' => 40000], // Spark Plug
            ['service_id' => 5, 'spare_part_id' => 11, 'quantity' => 4, 'price' => 120000], // Transmission Oil
        ];

        foreach ($serviceItems as $itemData) {
            ServiceItem::create($itemData);
        }

        // Create Sample Invoices
        $invoices = [
            [
                'service_id' => 1,
                'invoice_date' => now()->subDays(30),
                'due_date' => now()->subDays(23),
                'subtotal' => Service::find(1)->total_cost,
                'tax' => 0,
                'discount' => 0,
                'total' => Service::find(1)->total_cost,
                'paid' => Service::find(1)->total_cost,
                'payment_status' => 'paid',
                'payment_method' => 'cash',
            ],
            [
                'service_id' => 2,
                'invoice_date' => now()->subDays(25),
                'due_date' => now()->subDays(18),
                'subtotal' => Service::find(2)->total_cost,
                'tax' => 0,
                'discount' => 50000,
                'total' => Service::find(2)->total_cost - 50000,
                'paid' => Service::find(2)->total_cost - 50000,
                'payment_status' => 'paid',
                'payment_method' => 'transfer',
            ],
            [
                'service_id' => 3,
                'invoice_date' => now()->subDays(20),
                'due_date' => now()->subDays(13),
                'subtotal' => Service::find(3)->total_cost,
                'tax' => 0,
                'discount' => 0,
                'total' => Service::find(3)->total_cost,
                'paid' => 200000,
                'payment_status' => 'partial',
                'payment_method' => 'cash',
            ],
            [
                'service_id' => 4,
                'invoice_date' => now()->subDays(15),
                'due_date' => now()->subDays(8),
                'subtotal' => Service::find(4)->total_cost,
                'tax' => 0,
                'discount' => 0,
                'total' => Service::find(4)->total_cost,
                'paid' => 0,
                'payment_status' => 'unpaid',
                'payment_method' => null,
            ],
            [
                'service_id' => 5,
                'invoice_date' => now()->subDays(10),
                'due_date' => now()->subDays(3),
                'subtotal' => Service::find(5)->total_cost,
                'tax' => 0,
                'discount' => 100000,
                'total' => Service::find(5)->total_cost - 100000,
                'paid' => 0,
                'payment_status' => 'unpaid',
                'payment_method' => null,
            ],
        ];

        foreach ($invoices as $invoiceData) {
            Invoice::create($invoiceData);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Email: admin@workshop.com');
        $this->command->info('Password: password');
    }
}