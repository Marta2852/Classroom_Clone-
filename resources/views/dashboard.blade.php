<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title fancy-title">📊 Dashboard</h2>
    </x-slot>

    <div class="dashboard-container fade-in">

        {{-- ===========================
            TEACHER DASHBOARD
        ============================ --}}
        @if(Auth::user()->role === 'teacher')

            <h2 class="section-title centered-title">
                ✨ Teacher Overview ✨
            </h2>

            {{-- ⭐ STATS CARDS --}}
            <div class="stats-wrapper">
                <div class="stat-card glass">
                    <p class="stat-label">Classes</p>
                    <h3 class="stat-value">{{ $classCount }}</h3>
                </div>

                <div class="stat-card glass">
                    <p class="stat-label">Assignments</p>
                    <h3 class="stat-value">{{ $assignmentCount }}</h3>
                </div>

                <div class="stat-card glass">
                    <p class="stat-label">Students</p>
                    <h3 class="stat-value">{{ $studentCount }}</h3>
                </div>

                <div class="stat-card glass">
                    <p class="stat-label">Submissions</p>
                    <h3 class="stat-value">{{ $submissionCount }}</h3>
                </div>
            </div>


            {{-- 📌 RECENT ASSIGNMENTS --}}
            <div class="content-card glass fade-in-delay">
                <h3 class="card-title">📌 Recent Assignments</h3>

                @forelse($recentAssignments as $assignment)
                    <div class="list-row">
                        <div>
                            <strong>{{ $assignment->title }}</strong>
                            <p class="list-date">
                                {{ $assignment->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <a href="{{ route('teacher.assignments.show', $assignment->id) }}" class="view-btn">
                            View
                        </a>
                    </div>
                @empty
                    <p class="empty">No assignments created yet 💗</p>
                @endforelse
            </div>


            {{-- 📝 NEEDS GRADING --}}
            <div class="content-card glass fade-in-delay-2">
                <h3 class="card-title">📝 Needs Grading</h3>

                @forelse($needsGrading as $item)
                    <div class="list-row">
                        <div>
                            <strong>{{ $item->assignment->title }}</strong>
                            <p class="list-date">
                                submitted by {{ $item->student->name }}
                            </p>
                        </div>

                        <a href="{{ route('teacher.assignments.show', $item->assignment->id) }}" class="view-btn">
                            Grade
                        </a>
                    </div>
                @empty
                    <p class="empty">Nothing to grade 🎉</p>
                @endforelse
            </div>

        @endif



        {{-- 🌸 STUDENT DASHBOARD --}}
        @if(Auth::user()->role === 'student')
            <div class="content-card glass fade-in">
                <h3 class="card-title">🎓 Welcome, Student!</h3>
                <p>Your classes are available from the navigation bar!</p>
            </div>
        @endif


        {{-- ⚙️ ADMIN DASHBOARD --}}
        @if(Auth::user()->role === 'admin')
            <div class="content-card glass fade-in">
                <h3 class="card-title">⚙️ Admin Panel</h3>
                <p>You can manage everything using the navigation bar.</p>
            </div>
        @endif

    </div>
</x-app-layout>
