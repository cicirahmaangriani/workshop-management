<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'service_id',
        'invoice_date',
        'due_date',
        'subtotal',
        'tax',
        'discount',
        'total',
        'paid',
        'payment_status',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'paid' => 'decimal:2',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getRemainingAttribute()
    {
        return $this->total - $this->paid;
    }

    public function updatePaymentStatus()
    {
        if ($this->paid >= $this->total) {
            $this->payment_status = 'paid';
        } elseif ($this->paid > 0) {
            $this->payment_status = 'partial';
        } else {
            $this->payment_status = 'unpaid';
        }
        $this->save();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (!$invoice->invoice_number) {
                $invoice->invoice_number = 'INV-' . date('Ymd') . '-' . str_pad(Invoice::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}