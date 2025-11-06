<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as Storage;
use Illuminate\Support\Facades\Auth as Auth;

class WeddingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $weddings = Wedding::orderBy('created_at', 'asc')->get();
        }
        else {
            $weddings = Wedding::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        }
        return view('admin.weddings.index', compact('weddings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/weddings';
        return view('admin.weddings.create', compact('user', 'path'));
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
                'wedding_image' => 'nullable|string|max:255',
                'wedding_title' => 'required|string|max:255',
                'wedding_sub_title' => 'required|string|max:255',
                'wedding_description' => 'required|string|max:1000',
                'wedding_prayer_verse' => '|string|max:1000',
                'wedding_video' => 'nullable|string|max:255',
                'wedding_audio' => 'nullable|string|max:255',
                'wedding_message_template' => 'required|string',
                'wedding_landing_image' => 'nullable|string|max:255',
                'wedding_landing_title' => 'required|string|max:255',
                'wedding_hotnews_image' => 'nullable|string|max:255',
                'wedding_hotnews_description' => 'required|string|max:1000',
            ]);
            
            Wedding::create([
                'user_id' => $user->id,
                'wedding_image' => $validated['wedding_image'] ?? null,
                'wedding_title' => $validated['wedding_title'],
                'wedding_sub_title' => $validated['wedding_sub_title'],
                'wedding_description' => $validated['wedding_description'],
                'wedding_prayer_verse' => $validated['wedding_prayer_verse'],
                'wedding_video' => $validated['wedding_video'] ?? null,
                'wedding_audio' => $validated['wedding_audio'] ?? null,
                'wedding_message_template' => $validated['wedding_message_template'],
                'wedding_landing_image' => $validated['wedding_landing_image'] ?? null,
                'wedding_landing_title' => $validated['wedding_landing_title'],
                'wedding_hotnews_image' => $validated['wedding_hotnews_image'] ?? null,
                'wedding_hotnews_description' => $validated['wedding_hotnews_description'],
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Wedding $wedding)
    {
        $userId = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($userId)) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        }
        $weddingOwner= User::find($userId)->id;
        $wedding = Wedding::where('user_id', $weddingOwner)->first();
        return view('admin.weddings.show', compact('wedding'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wedding $wedding)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/weddings';
        return view('admin.weddings.edit', compact('wedding', 'user', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wedding $wedding)
    {

        $validated['user_id'] = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } 
        else {
            $user = User::find($validated['user_id']);
            $validated = $request->validate([
                'wedding_image' => 'nullable|string|max:255',
                'wedding_title' => 'required|string|max:255',
                'wedding_sub_title' => 'required|string|max:255',
                'wedding_description' => 'required|string|max:1000',
                'wedding_prayer_verse' => '|string|max:1000',
                'wedding_video' => 'nullable|string|max:255',
                'wedding_audio' => 'nullable|string|max:255',
                'wedding_message_template' => 'required|string',
                'wedding_landing_image' => 'nullable|string|max:255',
                'wedding_landing_title' => 'required|string|max:255',
                'wedding_hotnews_image' => 'nullable|string|max:255',
                'wedding_hotnews_description' => 'required|string|max:1000',
            ]);
        
            // Update the wedding invitation
            $wedding->user_id = $user->id;
            $wedding->wedding_image = isset($validated['wedding_image']) ? $validated['wedding_image'] : $wedding->wedding_image;
            $wedding->wedding_sub_title = $validated['wedding_sub_title'];
            $wedding->wedding_title = $validated['wedding_title'];
            $wedding->wedding_description = $validated['wedding_description'];
            $wedding->wedding_prayer_verse = $validated['wedding_prayer_verse'];
            $wedding->wedding_video = isset($validated['wedding_video']) ? $validated['wedding_video'] : $wedding->wedding_video;
            $wedding->wedding_audio = isset($validated['wedding_audio']) ? $validated['wedding_audio'] : $wedding->wedding_audio;
            $wedding->wedding_message_template = $validated['wedding_message_template'];
            $wedding->wedding_landing_image = isset($validated['wedding_landing_image']) ? $validated['wedding_landing_image'] : $wedding->wedding_landing_image;
            $wedding->wedding_landing_title = $validated['wedding_landing_title'];
            $wedding->wedding_hotnews_image = isset($validated['wedding_hotnews_image']) ? $validated['wedding_hotnews_image'] : $wedding->wedding_hotnews_image;
            $wedding->wedding_hotnews_description = $validated['wedding_hotnews_description'];
            $wedding->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wedding $wedding)
    {
        // Delete the wedding invitation
        $wedding->delete();
        return redirect()->route('weddings.index')->with('success', 'Wedding deleted successfully!');
    }
 
}
