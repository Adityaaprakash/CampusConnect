<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'description',
        'type',
        'created_by',
        'invite_permission',
    ];

    /**
     * Creator of the room.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Messages in this room.
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }

    /**
     * Members of this room.
     */
    public function members()
    {
        return $this->hasMany(ChatMember::class, 'room_id');
    }

    /**
     * Users in this room (through pivot).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_members', 'room_id', 'user_id')
            ->withTimestamps()
            ->withPivot('is_admin');
    }
}
