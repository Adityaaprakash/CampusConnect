<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Display only approved notes to the public/students.
     */
    public function index()
    {
        $notes = Note::where('status', 'approved')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('notes.view', compact('notes'));
    }

    /**
     * Show the upload notes form (only for authenticated users).
     */
    public function uploadForm()
    {
        return view('notes.upload');
    }

    /**
     * Handle file upload from student.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'department'  => 'required|string|max:255',
            'semester'    => 'required|string|max:255',
            'subject'     => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|mimes:pdf|max:20480', // 20MB max
        ]);

        // File handling
        $file = $request->file('file');
        $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        $file->move(public_path('uploads'), $fileName);

        // Create note entry in database
        Note::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'department'  => $request->department,
            'semester'    => $request->semester,
            'subject'     => $request->subject,
            'description' => $request->description,
            'file_name'   => $fileName,
            'status'      => 'pending',   // default until admin approves
        ]);

        return redirect()
                ->back()
                ->with('success', 'Notes uploaded successfully! Your credits will be added once the admin approves your notes.');
    }
}
