<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedUser = Auth::id();
        $user = User::find($loggedUser);
        if ($user->isAdmin()) {
            $users = User::orderBy('created_at', 'asc')->get();
            return view('admin.users.index', compact('users'));
        } else {
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
        if ($user->isAdmin()) {
            return view('admin.users.create');
        } else {
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
        if ($user->isAdmin()) {
            $validated = $request->validate([
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            User::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } else {
            return view('dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // You can implement this if needed.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $loggedUser = Auth::id();
        $userAuth = User::find($loggedUser);
        if ($userAuth->isAdmin()) {
            return view('admin.users.edit', compact('user'));
        } else {
            return view('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $loggedUser = Auth::id();
        $userAuth = User::find($loggedUser);
        if ($userAuth->isAdmin()) {
            $validated = $request->validate([
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6',
            ]);

            $user->name = $validated['name'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }
            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } else {
            return view('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $loggedUser = Auth::id();
        $userAuth = User::find($loggedUser);

        // Ensure only an admin can delete other users
        if ($userAuth->isAdmin()) {
            // Check if the user trying to be deleted is not the logged-in user (if needed)
            if ($user->id !== $loggedUser) {
                $user->delete();
                return redirect()->route('users.index')->with('success', 'User deleted successfully!');
            } else {
                return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
            }
        } else {
            return view('dashboard');
        }
    }
}
