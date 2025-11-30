<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total users
        $totalUsers = User::count();

        // Notes
        $totalNotes = Note::count();
        $pendingNotes = Note::where('status', 'pending')->count();
        $approvedNotes = Note::where('status', 'approved')->count();
        $rejectedNotes = Note::where('status', 'rejected')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalNotes',
            'pendingNotes',
            'approvedNotes',
            'rejectedNotes'
        ));
    }
}
