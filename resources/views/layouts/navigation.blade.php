<nav class="main-nav">
    <div class="nav-container">

        <!-- LEFT SIDE: avatar + name + links -->
        <div class="nav-left">

            <!-- Avatar + Name -->
            <a href="{{ route('profile.edit') }}" class="nav-user">
    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="nav-avatar">
    <span class="nav-username">{{ Auth::user()->name }}</span>
</a>




            <!-- Normal nav links -->
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

        <!-- RIGHT SIDE -->
        <div class="nav-right">
            <button id="themeToggle" class="theme-toggle">🌙</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>

    </div>
</nav>
