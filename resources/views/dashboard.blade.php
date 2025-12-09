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





        {{-- ===========================
             🌸 STUDENT DASHBOARD
        ============================ --}}
        @if(Auth::user()->role === 'student')

            <h2 class="section-title centered-title fade-in">
                🌸 Student Dashboard 🌸
            </h2>

            {{-- ⭐ STUDENT STATS --}}
<div class="stats-wrapper fade-in-delay">
    <div class="stat-card glass">
        <p class="stat-label">My Classes</p>
        <h3 class="stat-value">{{ $studentClasses->count() }}</h3>
    </div>

    <div class="stat-card glass">
        <p class="stat-label">Pending Assignments</p>
        <h3 class="stat-value">{{ $pendingAssignments->count() }}</h3>
    </div>

    <div class="stat-card glass">
        <p class="stat-label">Completed</p>
        <h3 class="stat-value">{{ $completedAssignmentsCount }}</h3>
    </div>

    <div class="stat-card glass">
        <p class="stat-label">Total Submissions</p>
        <h3 class="stat-value">{{ $studentSubmissionCount }}</h3>
    </div>
</div>



            {{-- 📚 MY CLASSES --}}
            <div class="content-card glass fade-in-delay">
                <h3 class="card-title">📚 My Classes</h3>

                @forelse($studentClasses as $class)
                    <div class="list-row">
                        <div>
                            <strong>{{ $class->name }}</strong>
                            <p class="list-date">
                                Teacher: {{ $class->teacher->name }}
                            </p>
                        </div>

                        <a href="{{ route('student.assignments.index', $class) }}" class="view-btn">
                            View
                        </a>
                    </div>
                @empty
                    <p class="empty">You are not enrolled in any classes yet 🌼</p>
                @endforelse
            </div>


            {{-- 📝 PENDING ASSIGNMENTS --}}
            <div class="content-card glass fade-in-delay-2">
                <h3 class="card-title">📝 Pending Assignments</h3>

                @forelse($pendingAssignments as $assignment)
                    <div class="list-row">
                        <div>
                            <strong>{{ $assignment->title }}</strong>
                            <p class="list-date">
                                Class: {{ $assignment->classroom->name }}
                            </p>
                        </div>

                        <a href="{{ route('student.assignments.show', $assignment) }}" class="view-btn">
                            Open
                        </a>
                    </div>
                @empty
                    <p class="empty">🎉 No assignments left to do!</p>
                @endforelse
            </div>

        @endif




        {{-- ===========================
             ⚙️ ADMIN DASHBOARD
        ============================ --}}
        @if(Auth::user()->role === 'admin')

    <h2 class="section-title centered-title fade-in">
        ⚙️ Admin Overview
    </h2>

    <!-- GLOBAL STATISTICS -->
    <div class="stats-wrapper fade-in-delay">

        <div class="stat-card glass">
            <p class="stat-label">Total Users</p>
            <h3 class="stat-value">{{ $totalUsers }}</h3>
        </div>

        <div class="stat-card glass">
            <p class="stat-label">Students</p>
            <h3 class="stat-value">{{ $totalStudents }}</h3>
        </div>

        <div class="stat-card glass">
            <p class="stat-label">Teachers</p>
            <h3 class="stat-value">{{ $totalTeachers }}</h3>
        </div>

        <div class="stat-card glass">
            <p class="stat-label">Classes</p>
            <h3 class="stat-value">{{ $totalClasses }}</h3>
        </div>

        <div class="stat-card glass">
            <p class="stat-label">Assignments</p>
            <h3 class="stat-value">{{ $totalAssignments }}</h3>
        </div>

        <div class="stat-card glass">
            <p class="stat-label">Submissions</p>
            <h3 class="stat-value">{{ $totalSubmissions }}</h3>
        </div>

    </div>

@endif


    </div>
</x-app-layout>
