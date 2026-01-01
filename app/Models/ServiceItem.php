<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'spare_part_id',
        'quantity',
        'price',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class);
    }

    // ✅ Accessor untuk Subtotal (price * quantity)
    public function getSubtotalAttribute()
    {
        return ($this->price ?? 0) * ($this->quantity ?? 0);
    }
}