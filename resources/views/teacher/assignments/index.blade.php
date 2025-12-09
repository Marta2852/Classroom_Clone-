<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Assignments for {{ $classroom->name }}</h2>
    </x-slot>

    <!-- Centered container like dashboard -->
    <div class="max-w-4xl mx-auto">

        <!-- Create Assignment Button -->
        <div class="flex justify-end mb-6">
            <a href="{{ route('teacher.assignments.create', $classroom) }}"
               class="btn-primary inline-flex items-center">
                <span class="mr-2">➕</span>Create Assignment
            </a>
        </div>

        <!-- Assignment List -->
        <div class="space-y-6">

            @forelse($assignments as $assignment)
                <div class="card">

                    <h2 class="card-title">{{ $assignment->title }}</h2>

                    <p class="card-description">
                        {{ $assignment->description ?? 'No description provided.' }}
                    </p>

                    <div class="mt-4 space-y-3 text-sm text-gray-700">

                        <div class="assignment-meta">

    <div>
        <span class="text-lg">📅</span>
        <span>Created {{ $assignment->created_at->diffForHumans() }}</span>
    </div>

    <div>
        <span class="text-lg">📥</span>
        <span>{{ $assignment->submissions->count() }} Submissions</span>
    </div>

</div>


                    </div>

                    <div class="mt-4">
                        <a href="{{ route('teacher.assignments.show', $assignment) }}"
                           class="btn-secondary">
                            Open Assignment
                        </a>
                    </div>

                </div>
            @empty
                <div class="card">
                    <p class="empty">No assignments yet.</p>
                </div>
            @endforelse

        </div>

    </div>
</x-app-layout>
