<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $table = 'rents';

    protected $fillable = [
        'title',
        'rent',
        'location',
        'full_address',
        'description',
        'amenities',
        'owner_name',
        'phone',
        'created_by',
        'deposit',
        'availability_status',
        'approved',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
