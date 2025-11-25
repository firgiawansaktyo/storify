<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use App\Models\User;

class HashtagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = trim($request->query('q', ''));

        $userName   = Auth::user()->username;
        $loggedUser = Auth::id();
        $user       = User::find($loggedUser);

        $query = Hashtag::query();
        if (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $hashtags = $query
            ->when($q !== '', function ($qbuilder) use ($q) {
                $qbuilder->where(function ($inner) use ($q) {
                    $inner->where('name', 'ilike', "%{$q}%");
                });
            })
            ->orderBy('name', 'asc')
            ->paginate(10)  
            ->withQueryString();    

        return view('admin.hashtags.index', [
            'userName'        => $userName,
            'hashtags'         => $hashtags,
            'q'               => $q,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hashtags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $validated['user_id'] = Auth::id();

        Hashtag::create([
            'user_id' => $validated['user_id'],
            'name' => $validated['name'],
        ]);

        return redirect()->route('hashtags.index')->with('success', 'Hashtag created successfully!');

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
    public function edit(Hashtag $hashtag)
    {
        return view('admin.hashtags.edit', compact('hashtag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hashtag $hashtag)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        
        $hashtag->name = $validated['name'];
        $hashtag->save();

        return redirect()->route('hashtags.index')->with('success', 'Hashtag updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hashtag $hashtag)
    {
        $hashtag->delete();
        return redirect()->route('hashtags.index')->with('success', 'Hashtag deleted successfully!');
    }

}
