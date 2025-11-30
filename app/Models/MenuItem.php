<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'name',
        'price',
        'image',
        'available',
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}


