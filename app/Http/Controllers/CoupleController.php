<?php

namespace App\Http\Controllers;

use App\Models\Couple;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Storage as Storage;



class CoupleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $couples = Couple::orderBy('created_at', 'asc')->get();
        }
        else {
            $couples = Couple::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        }
        return view('admin.couples.index', compact('couples'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/couples';
        return view('admin.couples.create', compact('user', 'path'));
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
                'bride_name' => 'required|string|max:255',
                'father_bride_name' => 'required|string|max:255',
                'mother_bride_name' => 'required|string|max:255',
                'groom_name' => 'required|string|max:255',
                'father_groom_name' => 'required|string|max:255',
                'mother_groom_name' => 'required|string|max:255',
                'bride_image' => 'nullable|string|max:255',
                'groom_image' => 'nullable|string|max:255'
            ]);

            Couple::create([
                'user_id' => $user->id,
                'bride_name' => $validated['bride_name'],
                'father_bride_name' => $validated['father_bride_name'],
                'mother_bride_name' => $validated['mother_bride_name'],
                'groom_name' => $validated['groom_name'],
                'father_groom_name' => $validated['father_groom_name'],
                'mother_groom_name' => $validated['mother_groom_name'],
                'bride_image' => $validated['bride_image'] ?? null,
                'groom_image' => $validated['groom_image'] ?? null,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Couple $couple)
    {
        $userId = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($userId)) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        }
        $coupleOwner= User::find($userId)->id;
        $couple= Couple::where('user_id', $coupleOwner)->first();
        return view('admin.couples.show', compact('couple'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Couple $couple)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $path = $user->username . '/couples';
        return view('admin.couples.edit', compact('couple', 'user', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Couple $couple)
    {
        $validated['user_id'] = Auth::id();
        // Check if the user_id exists
        if (!\App\Models\User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } 
        else {
            $user = User::find($validated['user_id']);
            $oldBrideImage = $couple->bride_image;
            $oldGroomImage = $couple->groom_image;         
            $validated = $request->validate([
                'bride_name' => 'required|string|max:255',
                'father_bride_name' => 'required|string|max:255',
                'mother_bride_name' => 'required|string|max:255',
                'groom_name' => 'required|string|max:255',
                'father_groom_name' => 'required|string|max:255',
                'mother_groom_name' => 'required|string|max:255',
                'bride_image' => 'nullable|string|max:255',
                'groom_image' => 'nullable|string|max:255'
            ]);

            $couple->user_id = $user->id;
            $couple->bride_name = $validated['bride_name'];
            $couple->father_bride_name = $validated['father_bride_name'];
            $couple->mother_bride_name = $validated['mother_bride_name'];
            $couple->groom_name = $validated['groom_name'];
            $couple->father_groom_name = $validated['father_groom_name'];
            $couple->mother_groom_name = $validated['mother_groom_name'];
            $couple->bride_image = isset($validated['bride_image']) ? $validated['bride_image'] : $couple->bride_image;
            $couple->groom_image = isset($validated['groom_image']) ? $validated['groom_image'] : $couple->groom_image;
            $couple->save();
            if (
                $oldBrideImage &&
                $oldBrideImage !== $couple->bride_image &&
                Storage::disk('public')->exists($oldBrideImage)) {
                Storage::disk('public')->delete($oldBrideImage);
            }
            if (
                $oldGroomImage &&
                $oldGroomImage !== $couple->groom_image &&
                Storage::disk('public')->exists($oldGroomImage)) {
                Storage::disk('public')->delete($oldGroomImage);        
            }  
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Couple $couple)
    {
        if ($couple->bride_image && Storage::disk('public')->exists($couple->bride_image)) {
            Storage::disk('public')->delete($couple->bride_image);
        }
        if ($couple->groom_image && Storage::disk('public')->exists($couple->groom_image)) {
            Storage::disk('public')->delete($couple->groom_image);
        }
        $couple->delete();
        return redirect()->route('couples.index')->with('success', 'Couple deleted successfully!');
    }
}
