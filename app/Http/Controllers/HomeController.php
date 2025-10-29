<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Invitation;
use App\Models\InvitedGuest;
use App\Models\Throwback;
use App\Models\User;
use App\Models\Wish;
use Illuminate\Support\Str;


use function Laravel\Prompts\text;

class HomeController extends Controller
{
    public function index($id)
    {
        if (!Str::isUuid($id)) {
            return view ('error.page', ['error' => 'Invalid invitation link.']);
        }

        $invitedGuest = InvitedGuest::where('id', $id)->first();
        if (!$invitedGuest) {
            return view ('error.page', ['error' => 'Invalid invitation link.']);
        }
        else {
            $wedding = User::where('users.id', $invitedGuest->user_id)
            ->join('invited_guests', 'invited_guests.user_id', '=', 'users.id')
            ->join('timelines', 'timelines.user_id', '=', 'users.id')
            ->join('couples', 'couples.user_id', '=', 'users.id')
            ->join('weddings', 'weddings.user_id', '=', 'users.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'invited_guests.*',
                'timelines.*',
                'couples.*',
                'weddings.*')
            ->first();

            $albums = Album::where('user_id', $invitedGuest->user_id)->orderBy('created_at', 'asc')->get();
            $throwbacks = Throwback::where('user_id', $invitedGuest->user_id)->orderBy('created_at', 'asc')->get();
            $wishes = Wish::where('user_id', $invitedGuest->user_id)->orderBy('created_at', 'asc')->get();
            return view('home', compact('wedding', 'albums', 'throwbacks', 'wishes'));
        }
    }

}

