<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Dashboard</h2>
    </x-slot>

    <div class="dashboard">

        {{-- ============================
            TEACHER DASHBOARD
        ============================ --}}
        @if(Auth::user()->role === 'teacher')

            <h2 class="section-title">Teacher Overview</h2>

            {{-- Stats --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>{{ $classCount }}</h3>
                    <p>Classes</p>
                </div>

                <div class="stat-card">
                    <h3>{{ $assignmentCount }}</h3>
                    <p>Assignments</p>
                </div>

                <div class="stat-card">
                    <h3>{{ $studentCount }}</h3>
                    <p>Total Students</p>
                </div>
            </div>


            {{-- ============================
                RECENT ASSIGNMENTS
            ============================ --}}
            <div class="dashboard-section mt-10">
                <h3 class="section-title">📌 Recent Assignments</h3>

                @forelse($recentAssignments as $assignment)
                    <div class="list-item">
                        <div>
                            <strong>{{ $assignment->title }}</strong>
                            <p class="text-sm text-gray-600">
                                {{ $assignment->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <a href="{{ route('teacher.assignments.show', $assignment->id) }}"
                           class="view-link">
                            View
                        </a>
                    </div>
                @empty
                    <p class="empty">No recent assignments.</p>
                @endforelse
            </div>

        @endif



        {{-- ============================
            STUDENT DASHBOARD
        ============================ --}}
        @if(Auth::user()->role === 'student')
            <h2 class="section-title">Welcome, Student!</h2>
            <p>Your classes and assignments are available in the menu.</p>
        @endif



        {{-- ============================
            ADMIN DASHBOARD
        ============================ --}}
        @if(Auth::user()->role === 'admin')
            <h2 class="section-title">Admin Panel</h2>
            <p>Manage users and logs from the navigation bar.</p>
        @endif

    </div>
</x-app-layout>
