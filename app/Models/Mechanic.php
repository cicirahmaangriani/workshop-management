<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'specialization',
        'status'
    ];

    // Relasi ke Services
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
