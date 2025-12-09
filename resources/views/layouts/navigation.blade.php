<nav class="main-nav">
    <div class="nav-container">

        {{-- LEFT SIDE LINKS --}}
        <div class="nav-left">
            <a href="{{ route('dashboard') }}">Dashboard</a>

            @if(Auth::user()->role === 'teacher')
                <a href="{{ route('teacher.classes.index') }}">Classes</a>
                <a href="{{ route('teacher.grading.index') }}">Grading</a>
            @endif

            @if(Auth::user()->role === 'student')
                <a href="{{ route('student.classes') }}">My Classes</a>
                <a href="{{ route('student.join') }}">Join Class</a>
            @endif

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}">Users</a>
                <a href="{{ route('admin.logs.index') }}">Logs</a>
            @endif
        </div>

        {{-- RIGHT SIDE --}}
        <div class="nav-right">

            {{-- DARK MODE SWITCH --}}
            <button id="themeToggle" class="theme-toggle">🌙</button>

            <span class="nav-user">{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>

    </div>
</nav>
