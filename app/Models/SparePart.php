<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $table = 'spare_parts';

    protected $fillable = [
        'code',
        'name',
        'category',
        'description',
        'purchase_price',
        'selling_price',
        'stock',
        'min_stock'
    ];

    // Relasi ke Service Items
    public function serviceItems()
    {
        return $this->hasMany(ServiceItem::class);
    }

    // Scope untuk stok menipis
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'min_stock');
    }
}
