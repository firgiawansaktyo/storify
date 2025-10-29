@extends('layouts.app')
@section('content')
 <div class="min-h-screen bg-[var(--spotify-black)]">
  <div class="max-w-xl container justify-self-center">
    <x-invitation :wedding=$wedding :albums="$albums" :throwbacks="$throwbacks" :wishes="$wishes" />
  </div>
</div>
@endsection