<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Events\MessageSent;
use App\Models\ChatMember;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show list of chat rooms and allow creating new room.
     */
    public function index()
    {
        $user = Auth::user();

        // Rooms this user is a member of
        $myRooms = $user->chatRooms()->orderBy('room_name')->get();

        // Public rooms (can be joined)
        $publicRooms = ChatRoom::where('type', 'public')
            ->orderBy('room_name')
            ->get();

        return view('chat.index', compact('myRooms', 'publicRooms'));
    }

    /**
     * Store a new chat room.
     */
    public function storeRoom(Request $request)
    {
        $data = $request->validate([
            'room_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'type' => 'required|in:public,private',
            'invite_permission' => 'nullable|boolean',
        ]);

        $data['created_by'] = Auth::id();
        $data['invite_permission'] = $request->boolean('invite_permission', true);

        $room = ChatRoom::create($data);

        // Creator automatically becomes admin member
        ChatMember::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'is_admin' => true,
        ]);

        return redirect()->route('chat.rooms.show', $room)
            ->with('success', 'Chat room created successfully.');
    }

    /**
     * Join a room.
     */
    public function join(ChatRoom $room)
    {
        $user = Auth::user();

        // For private rooms you might add additional checks here (invites etc.).
        ChatMember::firstOrCreate(
            [
                'room_id' => $room->id,
                'user_id' => $user->id,
            ],
            [
                'is_admin' => false,
            ]
        );

        return redirect()->route('chat.rooms.show', $room);
    }

    /**
     * Leave a room.
     */
    public function leave(ChatRoom $room)
    {
        ChatMember::where('room_id', $room->id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('chat.index')
            ->with('success', 'You left the room.');
    }

    /**
     * Show a specific room with messages.
     */
    public function show(ChatRoom $room)
    {
        $user = Auth::user();

        // Ensure user is a member of this room
        $isMember = ChatMember::where('room_id', $room->id)
            ->where('user_id', $user->id)
            ->exists();

        if (! $isMember) {
            return redirect()->route('chat.index')
                ->with('error', 'You are not a member of that room.');
        }

        $messages = $room->messages()
            ->with('user')
            ->orderBy('created_at')
            ->get();

        return view('chat.room', compact('room', 'messages'));
    }

    /**
     * Store a new message in a room.
     *
     * (Later we can broadcast this via WebSockets for real-time updates.)
     */
    public function storeMessage(Request $request, ChatRoom $room)
    {
        // Basic text-only for now
        $data = $request->validate([
            'message_text' => 'required|string|max:2000',
        ]);

        // Ensure the user is a member
        $isMember = ChatMember::where('room_id', $room->id)
            ->where('user_id', Auth::id())
            ->exists();

        if (! $isMember) {
            return redirect()->route('chat.index')
                ->with('error', 'You are not a member of that room.');
        }

        $message = Message::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'message_text' => $data['message_text'],
        ]);

        $message->load('user');

        // Broadcast the message so other members see it instantly
        broadcast(new MessageSent($message))->toOthers();

        return redirect()
            ->route('chat.rooms.show', $room)
            ->with('success', 'Message sent.');
    }
}
