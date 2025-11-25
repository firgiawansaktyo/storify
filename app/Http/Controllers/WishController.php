<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{

    public function store(Request $request, $user_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'message' => 'required|string|min:10|max:1000',
        ]);

        $safeName = strip_tags($validated['name']);
        $safeMessage = strip_tags($validated['message']);

        Wish::create([
            'user_id' => $user_id,
            'name' => $safeName,
            'message' => $safeMessage,
        ]);
        return redirect()->back()->with('success', 'Your wish has been sent!');
    }

    public function json($user_id)
    {
        $wishes = Wish::where('user_id', $user_id)->orderBy('created_at', 'asc')->get();
        return response()->json([
            'wishes' => $wishes
        ]);
    }
}
