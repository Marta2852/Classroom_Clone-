<x-app-layout>
    <div class="dashboard-container fade-in">

        <h1 class="page-title centered-title mb-6">📚 My Classes</h1>

        @forelse($classes as $class)
            <div class="student-class-card hover-grow">

                {{-- Class Header --}}
                <div class="student-class-header">
                    <h2 class="student-class-title">{{ $class->name }}</h2>

                    <p class="student-class-desc">
                        {{ $class->description ?? 'No description available.' }}
                    </p>
                </div>

                {{-- Button --}}
                <div class="student-class-btn">
                    <a href="{{ route('student.assignments.index', $class->id) }}" class="btn-primary">
                        📘 View Assignments
                    </a>
                </div>
            </div>
        @empty
            <p class="empty mt-6">You are not enrolled in any classes yet 🌸</p>
        @endforelse

    </div>
</x-app-layout>
