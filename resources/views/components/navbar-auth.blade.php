<!-- NAVIGATION -->
@php
    //check url for page we are in
    $segment = Request::segment(1);
    //below use url segment to determine which page we are on and add active class to it if they match
@endphp
<nav class="navigation">
    <div class="auth-inline-item"></div>
        <a href="/dashboard" class="nav-text @if($segment == 'dashboard') active @endif">Dashboard</a>
        <a href="/warframes?type=Warframes" class="nav-text @if($segment == 'warframes') active @endif">Warframes</a>
        <a href="/primary?type=Primary" class="nav-text @if($segment == 'primary') active @endif">Primary Weapons</a>
        <a href="/secondary?type=Secondary" class="nav-text @if($segment == 'secondary') active @endif">Secondary Weapons</a>
        <a href="/melee?type=Melee" class="nav-text @if($segment == 'melee') active @endif">Melee Weapons</a>
    </div>
    <div class="auth-inline-item">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="danger-button">Log out</button>
        </form>
    </div>
</nav>
