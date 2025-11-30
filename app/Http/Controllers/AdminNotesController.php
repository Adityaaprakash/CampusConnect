<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;

class AdminNotesController extends Controller
{
    /**
     * Show all pending notes for admin review.
     */
    public function pending()
    {
        $notes = Note::where('status', 'pending')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('admin.notes.pending', compact('notes'));
    }

    /**
     * Approve a note and award credits to uploader.
     */
    public function approve($id)
    {
        $note = Note::findOrFail($id);

        // Prevent approving again
        if ($note->status === 'approved') {
            return redirect()
                ->back()
                ->with('info', 'This note is already approved.');
        }

        // Update note status
        $note->status = 'approved';
        $note->save();

        // Award credits to the user
        $user = User::findOrFail($note->user_id);
        $user->credits = $user->credits + 10;
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Note approved successfully! 10 credits added to the student.');
    }

    /**
     * Reject a note.
     */
    public function reject($id)
    {
        $note = Note::findOrFail($id);

        if ($note->status === 'rejected') {
            return redirect()
                ->back()
                ->with('info', 'This note is already rejected.');
        }

        $note->status = 'rejected';
        $note->save();

        return redirect()
            ->back()
            ->with('error', 'Note has been rejected.');
    }
}
