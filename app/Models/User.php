<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Chat rooms this user is a member of.
     */
    public function chatRooms()
    {
        return $this->belongsToMany(ChatRoom::class, 'chat_members', 'user_id', 'room_id')
            ->withTimestamps()
            ->withPivot('is_admin');
    }

    /**
     * Messages sent by this user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    /**
     * Credit logs for this user.
     */
    public function creditLogs()
    {
        return $this->hasMany(CreditLog::class, 'user_id');
    }

    /**
     * Simple helper to get total remaining credits:
     * sum(credit_logs) - sum(credits_used in food orders).
     */
    public function foodOrders()
    {
        return $this->hasMany(FoodOrder::class, 'user_id');
    }

    public function getCreditBalanceAttribute(): int
    {
        $earned = $this->creditLogs()->sum('credits_added');
        $spent = $this->foodOrders()->sum('credits_used');

        return $earned - $spent;
    }
}
