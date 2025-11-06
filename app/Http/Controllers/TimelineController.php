<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Storage as Storage;


class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $timelines = Timeline::orderBy('created_at', 'asc')->get();
        }
        else {
            $timelines = Timeline::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        }
        return view('admin.timelines.index', compact('timelines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/timelines';
        return view('admin.timelines.create', compact('user', 'path'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated['user_id'] = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } 
        else {
            $user = User::find($validated['user_id']);
            $validated = $request->validate([
                'wedding_vow_date' => 'required|date',
                'wedding_vow_start_time' => 'required|date_format:H:i',
                'wedding_vow_end_time' => 'required|date_format:H:i',
                'wedding_vow_location' => 'required|string',
                'wedding_vow_address' => 'required|string',
                'wedding_vow_iframe' => 'required|string',
                'wedding_reception_date' => 'required|date',
                'wedding_reception_start_time' => 'required|date_format:H:i',
                'wedding_reception_end_time' => 'required|date_format:H:i',
                'wedding_reception_location' => 'required|string',
                'wedding_reception_address' => 'required|string',
                'wedding_reception_iframe' => 'required|string',
                'wedding_vow_image' => 'nullable|string|max:255',
                'wedding_reception_image' => 'nullable|string|max:255',
                'wedding_vow_location_link' => 'required|string',
                'wedding_reception_location_link' => 'required|string',

            ]);

            Timeline::create([
                'user_id' => $user->id,
                'wedding_vow_date' => $validated['wedding_vow_date'],
                'wedding_vow_start_time' => $validated['wedding_vow_start_time'],
                'wedding_vow_end_time' => $validated['wedding_vow_end_time'],
                'wedding_vow_location' => $validated['wedding_vow_location'],
                'wedding_vow_address' => $validated['wedding_vow_address'],
                'wedding_vow_iframe' => $validated['wedding_vow_iframe'],
                'wedding_reception_date' => $validated['wedding_reception_date'],
                'wedding_reception_start_time' => $validated['wedding_reception_start_time'],
                'wedding_reception_end_time' => $validated['wedding_reception_end_time'],
                'wedding_reception_location' => $validated['wedding_reception_location'],
                'wedding_reception_address' => $validated['wedding_reception_address'],
                'wedding_reception_iframe' => $validated['wedding_reception_iframe'],
                'wedding_vow_image' => $validated['wedding_vow_image'] ?? null,
                'wedding_reception_image' => $validated['wedding_reception_image'] ?? null,
                'wedding_vow_location_link' => $validated['wedding_vow_location_link'],
                'wedding_reception_location_link' => $validated['wedding_reception_location_link'],
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Timeline $timeline)
    {
        $userId = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($userId)) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        }
        $timelineOwner= User::find($userId)->id;
        $timeline= Timeline::where('user_id', $timelineOwner)->first();
        return view('admin.timelines.show', compact('timeline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timeline $timeline)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/timelines';
        return view('admin.timelines.edit', compact('timeline', 'user', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timeline $timeline)
    {
        $validated['user_id'] = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } 
        else {
            $oldVowImage = $timeline->wedding_vow_image;
            $oldReceptionImage = $timeline->wedding_reception_image;
            $validated = $request->validate([
                'wedding_vow_date' => 'required|date',
                'wedding_vow_start_time' => 'required|date_format:H:i',
                'wedding_vow_end_time' => 'required|date_format:H:i',
                'wedding_vow_location' => 'required|string',
                'wedding_vow_address' => 'required|string',
                'wedding_vow_iframe' => 'required|string',
                'wedding_reception_date' => 'required|date',
                'wedding_reception_start_time' => 'required|date_format:H:i',
                'wedding_reception_end_time' => 'required|date_format:H:i',
                'wedding_reception_location' => 'required|string',
                'wedding_reception_address' => 'required|string',
                'wedding_reception_iframe' => 'required|string',
                'wedding_vow_image' => 'nullable|string|max:255',
                'wedding_reception_image' => 'nullable|string|max:255',
                'wedding_vow_location_link' => 'required|string',
                'wedding_reception_location_link' => 'required|string',
            ]);
        
            // Update the wedding invitation
            $timeline->wedding_vow_date = $validated['wedding_vow_date'];
            $timeline->wedding_vow_start_time = $validated['wedding_vow_start_time'];
            $timeline->wedding_vow_end_time = $validated['wedding_vow_end_time'];
            $timeline->wedding_vow_location = $validated['wedding_vow_location'];
            $timeline->wedding_vow_address = $validated['wedding_vow_address'];
            $timeline->wedding_vow_iframe = $validated['wedding_vow_iframe'];
            $timeline->wedding_reception_date = $validated['wedding_reception_date'];
            $timeline->wedding_reception_start_time = $validated['wedding_reception_start_time'] ?? null;
            $timeline->wedding_reception_end_time = $validated['wedding_reception_end_time'];
            $timeline->wedding_reception_location = $validated['wedding_reception_location'] ?? null;
            $timeline->wedding_reception_address = $validated['wedding_reception_address'];
            $timeline->wedding_reception_iframe = $validated['wedding_reception_iframe'];
            $timeline->wedding_vow_image = isset($validated['wedding_vow_image']) ? $validated['wedding_vow_image'] : $timeline->wedding_vow_image;
            $timeline->wedding_reception_image = isset($validated['wedding_reception_image']) ? $validated['wedding_reception_image'] : $timeline->wedding_reception_image;
            $timeline->wedding_vow_location_link = $validated['wedding_vow_location_link'];
            $timeline->wedding_reception_location_link = $validated['wedding_reception_location_link'];
            $timeline->save();
            if (
                $oldVowImage &&
                $oldVowImage !== $timeline->wedding_vow_image &&
                Storage::disk('public')->exists($oldVowImage)) {
                Storage::disk('public')->delete($oldVowImage);
            }
            if (
                $oldReceptionImage &&
                $oldReceptionImage !== $timeline->wedding_reception_image &&
                Storage::disk('public')->exists($oldReceptionImage)) {
                Storage::disk('public')->delete($oldReceptionImage);
            }   
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeline $timeline)
    {
        if ($timeline->wedding_vow_image && Storage::disk('public')->exists($timeline->wedding_vow_image)) {
            Storage::disk('public')->delete($timeline->wedding_vow_image);
        }
        if ($timeline->wedding_reception_image && Storage::disk('public')->exists($timeline->wedding_reception_image)) {
            Storage::disk('public')->delete($timeline->wedding_reception_image);
        }
        $timeline->delete();
        return redirect()->route('timelines.index')->with('success', 'Timeline deleted successfully!');
    }
}
