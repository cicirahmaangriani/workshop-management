<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'customer_id',
        'license_plate',
        'brand',
        'model',
        'year',
        'color',
        'chassis_number',
        'engine_number'
    ];

    // ✅ Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // ✅ Relasi ke Services
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
