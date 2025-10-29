<?php

namespace App\Http\Controllers;

use App\Models\Throwback;
use App\Models\User;
use Illuminate\Support\Facades\Auth as Auth;

use Illuminate\Http\Request;

class ThrowbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->username == 'adminsweetvows') {
            $throwbacks = Throwback::orderBy('created_at', 'asc')->get();
        }
        else {
            $throwbacks = Throwback::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        }
        return view('admin.throwbacks.index', compact('throwbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/throwbacks';
        return view('admin.throwbacks.create', compact('user', 'path'));
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
                'wedding_throwback_title' => 'required|string|max:255',
                'wedding_throwback_description' => 'required|string',
                'wedding_throwback_image' => 'nullable|string|max:255'
            ]);

            Throwback::create([
                'user_id' => $user->id,
                'wedding_throwback_title' => $validated['wedding_throwback_title'],
                'wedding_throwback_description' => $validated['wedding_throwback_description'],
                'wedding_throwback_image' => $validated['wedding_throwback_image'] ?? null,
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
    public function edit(Throwback $throwback)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/throwbacks';
        return view('admin.throwbacks.edit', compact('throwback', 'user', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Throwback $throwback)
    {
        $validated['user_id'] = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } 
        else {
            $user = User::find($validated['user_id']);          
            $validated = $request->validate([
                'wedding_throwback_title' => 'required|string|max:255',
                'wedding_throwback_description' => 'required|string',
                'wedding_throwback_image' => 'nullable|string|max:255'
            ]);

            $throwback->user_id = $user->id;
            $throwback->wedding_throwback_title = $validated['wedding_throwback_title'];
            $throwback->wedding_throwback_description = $validated['wedding_throwback_description'];
            $throwback->wedding_throwback_image = isset($validated['wedding_throwback_image']) ? $validated['wedding_throwback_image'] : $throwback->wedding_throwback_image;
            $throwback->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Throwback $throwback)
    {
        $throwback->delete();
        return redirect()->route('throwbacks.index')->with('success', 'Throwback image deleted successfully!');
    }
}
