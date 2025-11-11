<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $albums = Album::orderBy('created_at', 'asc')->get();
        }
        else {
            $albums = Album::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        }
        return view('admin.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/albums';
        return view('admin.albums.create', compact('user', 'path'));
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
                'wedding_album_title' => 'required|string|max:255',
                'wedding_album_description' => 'required|string',
                'wedding_album_image' => 'nullable|string|max:255'
            ]);

            Album::create([
                'user_id' => $user->id,
                'wedding_album_title' => $validated['wedding_album_title'],
                'wedding_album_description' => $validated['wedding_album_description'],
                'wedding_album_image' => $validated['wedding_album_image'] ?? null,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/albums';
        return view('admin.albums.edit', compact('album', 'user', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $validated['user_id'] = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } 
        else {
            $user = User::find($validated['user_id']); 
            $oldAlbumImage = $album->bank_image;         
            $validated = $request->validate([
                'wedding_album_title' => 'required|string|max:255',
                'wedding_album_description' => 'required|string',
                'wedding_album_image' => 'nullable|string|max:255'
            ]);

            $album->user_id = $user->id;
            $album->wedding_album_title = $validated['wedding_album_title'];
            $album->wedding_album_description = $validated['wedding_album_description'];
            $album->wedding_album_image = isset($validated['wedding_album_image']) ? $validated['wedding_album_image'] : $album->wedding_album_image;
            $album->save();
            if (
                $oldAlbumImage &&
                $oldAlbumImage !== $album->wedding_album_image &&
                Storage::disk(env('FILESYSTEM_DISK'))->exists($oldAlbumImage)) {
                Storage::disk(env('FILESYSTEM_DISK'))->delete($oldAlbumImage);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->wedding_album_image && Storage::disk(env('FILESYSTEM_DISK'))->exists($album->wedding_album_image)) {
            Storage::disk(env('FILESYSTEM_DISK'))->delete($album->wedding_album_image);
        }
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album image deleted successfully!');
    }
}
