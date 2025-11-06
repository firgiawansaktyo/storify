<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as Auth;
use App\Models\User;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $banks = Bank::orderBy('created_at', 'asc')->get();
            return view('admin.banks.index', compact('banks'));
        }
        else {
            return view('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $path = '/banks';
            return view('admin.banks.create', compact('path'));
        }
        else {
            return view('dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $validated = $request->validate([
            'name' => 'required|string|max:100',
            'bank_image' => 'nullable|string|max:255',
            ]);

            Bank::create([
                'name' => $validated['name'],
                'bank_image' => $validated['bank_image'] ?? null,
            ]);
            return redirect()->route('banks.index')->with('success', 'Bank created successfully!!');
        }
        else {
            return view('dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $path = '/banks';
            return view('admin.banks.edit', compact('bank', 'path'));
        }
        else {
            return view('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            $validated = $request->validate([
            'name' => 'required|string|max:100',
            'bank_image' => 'nullable|string|max:255',
            ]);
            $oldBankImage = $bank->bank_image;
            $bank->name = $validated['name'];
            $bank->bank_image = isset($validated['bank_image']) ? $validated['bank_image'] : $bank->bank_image;
            $bank->save();
            if (
                $oldBankImage &&
                $oldBankImage !== $bank->bank_image &&
                Storage::disk('public')->exists($oldBankImage)) {
                Storage::disk('public')->delete($oldBankImage);
            }
        }
        else {
            return view('dashboard');
        }
        
    }

    public function destroy(Bank $bank)
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if($user->isAdmin()) {
            if ($bank->bank_image && Storage::disk('public')->exists($bank->bank_image)) {
                Storage::disk('public')->delete($bank->bank_image);
            }
            $bank->delete();
            return redirect()->route('banks.index')->with('success', 'Bank deleted successfully!');
        }
        else {
            return view('dashboard');
        }
    }
}
