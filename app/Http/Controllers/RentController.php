<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CreditLog;
use App\Models\PropertyImage;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RentController extends Controller
{
    /**
     * Show hero banner + some featured listings.
     */
    public function index()
    {
        // Only approved listings for public view
        $properties = Rent::where('approved', true)
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('rent.index', compact('properties'));
    }

    /**
     * Show all listings (list/grid view).
     */
    public function listings()
    {
        $properties = Rent::where('approved', true)
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('rent.listings', compact('properties'));
    }

    /**
     * Show a single property in detail.
     */
    public function show(Rent $rent)
    {
        // Only allow viewing approved listings, unless admin/owner
        if (! $rent->approved && ! Auth::check()) {
            abort(404);
        }

        $rent->load('images');

        // Decode amenities (stored as JSON or comma separated)
        $amenities = [];
        if ($rent->amenities) {
            $decoded = json_decode($rent->amenities, true);
            if (is_array($decoded)) {
                $amenities = $decoded;
            } else {
                $amenities = array_filter(array_map('trim', explode(',', $rent->amenities)));
            }
        }

        return view('rent.show', [
            'property' => $rent,
            'amenities' => $amenities,
        ]);
    }

    /**
     * Show form to create a new property.
     */
    public function create()
    {
        return view('rent.create');
    }

    /**
     * Store a new property submitted by student or admin.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'rent' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'full_address' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
            'owner_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'deposit' => 'nullable|integer|min:0',
            'availability_status' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        $rent = Rent::create([
            'title' => $data['title'],
            'rent' => $data['rent'],
            'location' => $data['location'],
            'full_address' => $data['full_address'] ?? null,
            'description' => $data['description'] ?? null,
            'amenities' => $data['amenities'] ?? null,
            'owner_name' => $data['owner_name'],
            'phone' => $data['phone'],
            'deposit' => $data['deposit'] ?? null,
            'availability_status' => $data['availability_status'] ?? 'available',
            'created_by' => $user->id,
            // For now auto-approve; you can flip this to false for admin review.
            'approved' => true,
        ]);

        // Award credits to the student for adding a property
        CreditLog::create([
            'user_id' => $user->id,
            'credits_added' => 50,
            'reason' => 'Property listed in Rent section (ID: ' . $rent->id . ')',
        ]);

        // Handle optional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('rent_images', 'public');

                PropertyImage::create([
                    'property_id' => $rent->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()
            ->route('rent.show', $rent)
            ->with('success', 'Property added successfully.');
    }

    /**
     * Delete a property (admin only – enforced by route middleware).
     */
    public function destroy(Rent $rent)
    {
        // Delete associated images from storage
        foreach ($rent->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $rent->delete();

        return redirect()
            ->route('rent.listings')
            ->with('success', 'Property deleted successfully.');
    }
}
