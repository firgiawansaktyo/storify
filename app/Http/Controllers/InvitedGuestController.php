<?php

namespace App\Http\Controllers;

use App\Imports\InvitedGuestsImport;
use App\Models\InvitedGuest;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\MessageTemplate;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Support\Facades\Storage as Storage;


class InvitedGuestController extends Controller
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

        $checkWedding    = Wedding::where('user_id', $loggedUser)->first();
        $messageTemplate = $checkWedding ? $checkWedding->wedding_message_template : null;

        $query = InvitedGuest::query();
        if (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $invitedGuests = $query
            ->when($q !== '', function ($qbuilder) use ($q) {
                $qbuilder->where(function ($inner) use ($q) {
                    $inner->where('name', 'ilike', "%{$q}%");
                });
            })
            ->orderBy('name', 'asc')
            ->paginate(10)  
            ->withQueryString();    

        return view('admin.invited-guests.index', [
            'userName'        => $userName,
            'messageTemplate' => $messageTemplate,
            'invitedGuests'   => $invitedGuests,
            'q'               => $q,
        ]);

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

        $path = $request->file('file')->store('temp/imports', env('FILESYSTEM_DRIVER'));
        try {

        Excel::import(new InvitedGuestsImport, $path, 'b2');
        Storage::disk(env('FILESYSTEM_DRIVER'))->delete($path);

    } catch (\Exception $e) {
        
        Storage::disk(env('FILESYSTEM_DRIVER'))->delete($path);
    }
        // Excel::import(new InvitedGuestsImport, $request->file('file'));

        return redirect()->route('invited-guests.index')->with('success', 'Import Invited Guest complete!');
    }

}
