<ul>
    <li class="nav-item @if(request()->routeIs('home')) active @endif">
        <a href="{{ route('home') }}">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" style="height: 22px; width: 22px; fill: none" fill="none" viewBox="0 0 22 22" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </span>
            <span class="text">{{ __('Dashboard') }}</span>
        </a>
    </li>

    <li class="nav-item @if(request()->routeIs('users.index')) active @endif">
        <a href="{{ route('users.index') }}">
             <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" style="height: 22px; width: 22px; fill: none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </span>
            <span class="text">{{ __('Users') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" onclick="event.preventDefault(); document.getElementById('cp-logout-form').submit();">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" style="height: 22px; width: 22px; fill: none" fill="none" viewBox="0 0 22 22" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </span>
            <span class="text">{{ __('Logout') }}</span>
        </a>
    </li>
</ul>
