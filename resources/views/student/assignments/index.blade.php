<x-app-layout>

    <div class="dashboard-container fade-in">

        <h1 class="page-title centered-title mb-6">
            📝 Assignments — {{ $classroom->name }}
        </h1>

        @forelse ($assignments as $assignment)
            <a href="{{ route('student.assignments.show', $assignment) }}" class="assignment-list-card hover-grow">

                <div class="assignment-list-header">
                    <h2 class="assignment-list-title">{{ $assignment->title }}</h2>

                    <p class="assignment-list-desc">
                        {{ $assignment->description ?? 'No description provided.' }}
                    </p>
                </div>

                <div class="assignment-list-footer">
                    <span class="assignment-date">
                        📅 Posted: {{ $assignment->created_at->format('M d, Y') }}
                    </span>

                    <span class="view-btn small-btn">
                        View →
                    </span>
                </div>

            </a>
        @empty
            <p class="empty mt-6">No assignments yet ✨</p>
        @endforelse

    </div>

</x-app-layout>
