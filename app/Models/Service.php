<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $casts = [
        'service_date' => 'date',
        'completion_date' => 'date',
    ];

    protected $fillable = [
        'service_number',
        'vehicle_id',
        'mechanic_id',
        'service_date',
        'complaint',
        'diagnosis',
        'action_taken',
        'status',
        'labor_cost',
        'estimated_days',
        'completion_date',
        'notes'
    ];

    // ✅ Relasi ke Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // ✅ Relasi ke Mechanic
    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    // ✅ Relasi ke Service Items
    public function serviceItems()
    {
        return $this->hasMany(ServiceItem::class);
    }

    // ✅ Relasi ke Invoice
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    // ✅ Accessor untuk Parts Cost (total harga spare parts)
    public function getPartsCostAttribute()
    {
        return $this->serviceItems->sum(function ($item) {
            return ($item->price ?? 0) * ($item->quantity ?? 0);
        });
    }

    // ✅ Accessor untuk Labor Cost (jika null, return 0)
    public function getLaborCostAttribute($value)
    {
        return $value ?? 0;
    }

    // ✅ Accessor untuk Total Cost (labor + parts) - ALWAYS calculated dynamically
    public function getTotalCostAttribute()
    {
        return ($this->attributes['labor_cost'] ?? 0) + $this->parts_cost;
    }

    // ✅ Method untuk menghitung dan menyimpan total cost ke database
    public function calculateTotalCost()
    {
        $totalCost = $this->labor_cost + $this->parts_cost;
        // Update directly in database without triggering model events
        \DB::table('services')
            ->where('id', $this->id)
            ->update(['total_cost' => $totalCost]);
        
        // Refresh the model to get updated data
        $this->refresh();
    }
}