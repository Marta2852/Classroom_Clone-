<x-app-layout>

    <x-slot name="header">
        <h2 class="page-title">
            My Classes
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">

        <!-- Create Class Button -->
        <a href="{{ route('teacher.classes.create') }}" class="btn-primary" style="margin-bottom: 20px; display: inline-block;">
            Create New Class
        </a>

        <!-- Class List -->
        <div class="mt-6 card-container">

            @forelse ($classes as $class)
                <div class="card">

                    <h2 class="card-title">{{ $class->name }}</h2>

                    <p class="card-description">
                        {{ $class->description ?? 'No description provided.' }}
                    </p>

                    <p style="margin-top: 12px; font-weight: 600; color: var(--pink-dark);">
                        Join Code:
                        <span class="join-code-box">{{ $class->join_code }}</span>
                    </p>

                    <div style="margin-top: 16px;">
                        <a href="{{ route('teacher.assignments.index', $class) }}" class="btn-secondary">
                            Open Class
                        </a>
                    </div>

                </div>

            @empty
                <div class="card">
                    <p class="card-description">You don't have any classes yet.</p>
                </div>
            @endforelse

        </div>

    </div>

</x-app-layout>
