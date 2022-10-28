<div class="sidebar">
    <a href="{{ route('mainPage') }}" class="d-flex justify-content-start align-items-center logo">
        <x-icon.link/>
        <span class="logo-title">ShrtLnk</span>
    </a>
    <ul>
        <li class="{{ Route::currentRouteName() === 'user.dashboard' ? 'active': ''}}">
            <a href="{{ route('user.dashboard') }}"><x-icon.home/>Dashboard</a>
        </li>
        <li class="{{ Route::currentRouteName() === 'user.links.create' ? 'active': ''}}">
            <a href="{{ route('user.links.create') }}"><x-icon.minimize/>Cut down</a>
        </li>
        <li class="{{ Route::currentRouteName() === 'user.links' ? 'active': ''}}">
            <a href="{{ route('user.links') }}"><x-icon.link/>My links</a>
        </li>
        <li class="{{ Route::currentRouteName() === 'user.links.groups' ? 'active': ''}}">
            <a href="{{ route('user.links.groups') }}"><x-icon.folder/>Groups</a>
        </li>
        <li class="{{ Route::currentRouteName() === 'user.logout' ? 'active': ''}}">
            <a href="{{ route('user.logout') }}"><x-icon.log_out/>Log out</a>
        </li>
    </ul>
</div>
