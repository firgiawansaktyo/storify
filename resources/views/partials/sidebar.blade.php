<ul class="navbar-nav bg-[var(--spotify-gray-bold)] sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard')}}">
    <div class="sidebar-brand-icon">
        <img 
        src="{{ asset('logo/swan-rounded.png') }}" 
        alt="Sweet Vows Logo" 
        class="w-10"/>
    </div>
    <div class="sidebar-brand-text mx-2">Sweet Vows Panel</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<li class="nav-item {{ request()->is('weddings') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('weddings.index')}}">
        <i class="fas fa-envelope"></i>
        <span>Weddings</span></a>
</li>
<li class="nav-item {{ request()->is('couples') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('couples.index')}}">
        <i class="fas fa-female"></i><i class="fas fa-male"></i>
        <span>Couples</span></a>
</li>
<li class="nav-item {{ request()->is('timelines') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('timelines.index')}}">
        <i class="fas fa-calendar"></i>
        <span>Timelines</span></a>
</li>
<li class="nav-item {{ request()->is('throwbacks') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('throwbacks.index')}}">
        <i class="fas fa-calendar"></i>
        <span>Throwbacks</span></a>
</li>
<li class="nav-item {{ request()->is('albums') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('albums.index')}}">
        <i class="fas fa-calendar"></i>
        <span>Albums</span></a>
</li>
<li class="nav-item {{ request()->is('gifts') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('gifts.index') }}">
        <i class="fas fa-gift"></i>
        <span>Gifts</span>
    </a>
</li>
<li class="nav-item {{ request()->is('invited-guests') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('invited-guests.index')}}">
        <i class="fas fa-users"></i>
        <span>Invited Guests</span></a>
</li>
<li class="nav-item {{ request()->is('hashtags') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('hashtags.index')}}">
        <i class="fa fa-hashtag"></i>
        <span>Hashtags</span>
    </a>
</li>
@if(auth()->check() && auth()->user()->is_admin)
</li>
<li class="nav-item {{ request()->is('banks') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('banks.index') }}">
        <i class="fa-solid fa-building-columns"></i>
        <span>Banks</span>
    </a>
</li>
<li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-user"></i>
        <span>Users</span>
    </a>
@endif



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>