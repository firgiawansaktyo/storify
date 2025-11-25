@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-[var(--spotify-black)] flex justify-center items-center">
  <div class="max-w-xl w-full overflow-hidden">
    <div class="transition-all duration-1000 ease-out opacity-0 translate-y-6 animate-fadeUp">
      <x-invitation :wedding=$wedding :albums=$albums :throwbacks=$throwbacks :wishes=$wishes :gifts=$gifts :banks=$banks :invitedGuestName=$invitedGuestName :hashtags=$hashtags />
    </div>
  </div>
</div>
@endsection
