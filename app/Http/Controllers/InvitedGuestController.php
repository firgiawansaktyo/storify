<?php

namespace App\Http\Controllers;

use App\Imports\InvitedGuestsImport;
use App\Models\InvitedGuest;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\MessageTemplate;
use Maatwebsite\Excel\Facades\Excel;

class InvitedGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invitedGuests = InvitedGuest::all();
        return view('admin.invited-guests.index', compact('invitedGuests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.invited-guests.create');
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

        InvitedGuest::create([
            'user_id' => $validated['user_id'],
            'name' => $validated['name'],
        ]);

        return redirect()->route('invited-guests.index')->with('success', 'Invited Guest created successfully!');

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
    public function edit(InvitedGuest $invitedGuest)
    {
        return view('admin.invited-guests.edit', compact('invitedGuest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvitedGuest $invitedGuest)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        
        $invitedGuest->name = $validated['name'];
        $invitedGuest->save();

        return redirect()->route('invited-guests.index')->with('success', 'Invited Guest updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvitedGuest $invitedGuest)
    {
        $invitedGuest->delete();
        return redirect()->route('invited-guests.index')->with('success', 'Invited Guest deleted successfully!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        Excel::import(new InvitedGuestsImport, $request->file('file'));

        return redirect()->route('invited-guests.index')->with('success', 'Import Invited Guest complete!');
    }

}
