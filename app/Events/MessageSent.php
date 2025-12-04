<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Message $message)
    {
    }

    /**
     * The channel the event should broadcast on.
     */
    public function broadcastOn(): Channel
    {
        // Private channel per room
        return new PrivateChannel('chat.room.' . $this->message->room_id);
    }

    /**
     * Event name on the frontend.
     */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    /**
     * Payload sent to the frontend.
     */
    public function broadcastWith(): array
    {
        $user = $this->message->user;

        return [
            'id' => $this->message->id,
            'room_id' => $this->message->room_id,
            'user_id' => $this->message->user_id,
            'user_name' => $user?->name ?? 'User ' . $this->message->user_id,
            'message_text' => $this->message->message_text,
            'created_at' => $this->message->created_at?->format('d M H:i'),
        ];
    }
}


