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
        'completion_date',
        'total_cost'
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
}