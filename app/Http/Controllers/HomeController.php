<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Invitation;
use App\Models\InvitedGuest;
use App\Models\Throwback;
use App\Models\User;
use App\Models\Wish;
use App\Models\Bank;
use App\Models\Gift;
use App\Models\Hashtag;
use Illuminate\Support\Str;


use function Laravel\Prompts\text;

class HomeController extends Controller
{
    public function index($username, $guestSlug)
    {
        $invitedGuest = InvitedGuest::where('slug', $guestSlug)->first();

        if (!$invitedGuest) {
            return view('error.page', ['error' => 'Invalid invitation link.']);
        }

        if ($invitedGuest->user->username !== $username) {
            return view('error.page', ['error' => 'Invalid invitation link.']);
        }

        $wedding = User::where('users.id', $invitedGuest->user_id)
            ->join('invited_guests', 'invited_guests.user_id', '=', 'users.id')
            ->join('timelines', 'timelines.user_id', '=', 'users.id')
            ->join('couples', 'couples.user_id', '=', 'users.id')
            ->join('weddings', 'weddings.user_id', '=', 'users.id')
            ->join('hashtags', 'hashtags.user_id', '=', 'users.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'invited_guests.*',
                'timelines.*',
                'couples.*',
                'weddings.*'
            )
            ->first();

        $invitedGuestName = $invitedGuest->name;
        $albums     = Album::where('user_id', $invitedGuest->user_id)->orderBy('created_at', 'asc')->get();
        $throwbacks = Throwback::where('user_id', $invitedGuest->user_id)->orderBy('created_at', 'asc')->get();
        $wishes     = Wish::where('user_id', $invitedGuest->user_id)->orderBy('created_at', 'asc')->get();
        $gifts      = Gift::with('bank')
            ->where('user_id', $invitedGuest->user_id)
            ->orderBy('created_at', 'asc')
            ->get();
        $banks      = Bank::whereIn('id', $gifts->pluck('bank_id')->filter()->unique())->get();
        $hashtags   = Hashtag::where('user_id', $invitedGuest->user_id)->orderBy('created_at', 'asc')->get();

        return view('home', compact('wedding', 'albums', 'throwbacks', 'wishes', 'banks', 'gifts', 'invitedGuestName', 'hashtags'));
    }

}

