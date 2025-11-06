<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\User;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);

        if ($user->isAdmin()) {
            $gifts = Gift::orderBy('created_at', 'asc')->get();
        } else {
            $gifts = Gift::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        }

        return view('admin.gifts.index', compact('gifts'));
    }

    public function create()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $banks = Bank::all();
        $path = $user->username . '/gifts';

        return view('admin.gifts.create', compact('user', 'banks', 'path'));
    }

    public function store(Request $request)
    {
        $validated['user_id'] = Auth::id();

        // Check if user exists
        if (!User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } else {
            $user = User::find($validated['user_id']);

            $validated = $request->validate([
                'bank_id' => 'nullable|exists:banks,id',
                'account_number' => 'required|string|max:50',
                'account_holder' => 'required|string|max:100',
                'qris_image' => 'nullable|string|max:255',
            ]);

            Gift::create([
                'user_id' => $user->id,
                'bank_id' => $validated['bank_id'],
                'account_number' => $validated['account_number'],
                'account_holder' => $validated['account_holder'], 
                'qris_image' => $validated['qris_image'] ?? null,
            ]);

            return redirect()->route('gifts.index')->with('success', 'Gift added successfully!');
        }
    }

    public function show(Gift $gift)
    {
    }

    public function edit(Gift $gift)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        $banks = Bank::all();
        $path = $user->username . '/gifts';

        return view('admin.gifts.edit', compact('gift', 'user', 'banks', 'path'));
    }

    public function update(Request $request, Gift $gift)
    {
        $validated['user_id'] = Auth::id();

        if (!User::find($validated['user_id'])) {
            return redirect()->back()->withErrors(['user_id' => 'User does not exist.']);
        } else {
            $user = User::find($validated['user_id']);
            $oldQrisImage = $gift->qris_image;

            $validated = $request->validate([
                'bank_id' => 'required|exists:banks,id',
                'account_number' => 'required|string|max:50',
                'account_holder' => 'required|string|max:100', 
                'qris_image' => 'nullable|string|max:255',
            ]);

            $gift->user_id = $user->id;
            $gift->bank_id = $validated['bank_id'];
            $gift->account_number = $validated['account_number'];
            $gift->account_holder = $validated['account_holder'];
            $gift->qris_image = isset($validated['qris_image'])
                ? $validated['qris_image']
                : $gift->qris_image;

            $gift->save();

            if (
                $oldQrisImage &&
                $oldQrisImage !== $gift->qris_image &&
                Storage::disk('public')->exists($oldQrisImage)
            ) {
                Storage::disk('public')->delete($oldQrisImage);
            }
        }
    }

    public function destroy(Gift $gift)
    {
        if ($gift->qris_image && Storage::disk('public')->exists($gift->qris_image)) {
            Storage::disk('public')->delete($gift->qris_image);
        }

        $gift->delete();

        return redirect()->route('gifts.index')->with('success', 'Gift deleted successfully!');
    }
}
