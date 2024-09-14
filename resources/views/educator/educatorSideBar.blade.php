<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link w-full {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Teacher Dashboard</span>
            </a>
        </li>

        <li class="nav-item flex">
            <a class="nav-link w-full {{ request()->routeIs('educator.module.index') ? 'active' : '' }}" href="{{ route('educator.module.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Module</span>
            </a>
        </li>

        <li class="nav-item flex">
            <a class="nav-link w-full {{ request()->routeIs('progress.index') ? 'active' : '' }}" href="{{ route('progress.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Student Progress</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link w-full {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Account Setting</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.logout') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Logout</span>
            </a>
        </li>
    </ul>
</nav>
