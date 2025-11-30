<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'user_id',
        'title',
        'department',
        'semester',
        'subject',
        'description',
        'file_name',
        'status',
    ];

    // Relationship: Note belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
