<?php

use App\Models\ChatMember;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.room.{roomId}', function ($user, int $roomId) {
    // Only allow users who are members of the room
    $isMember = ChatMember::where('room_id', $roomId)
        ->where('user_id', $user->id)
        ->exists();

    if (! $isMember) {
        return false;
    }

    // Data returned here is available as "auth" data on the frontend
    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});


