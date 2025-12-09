<x-app-layout>

    <x-slot name="header">
        <h2 class="page-title">My Classes</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">

        {{-- Header Row --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="section-title">Your Created Classes</h3>
                <p class="text-sm" style="color: var(--pink-dark); opacity: .7;">
                    You have {{ $classes->count() }} active class{{ $classes->count() !== 1 ? 'es' : '' }}.
                </p>
            </div>

            <a href="{{ route('teacher.classes.create') }}" class="btn-primary">
                ➕ Create New Class
            </a>
        </div>

        {{-- Class Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse ($classes as $class)
                <div class="card hover-grow">

                    {{-- Class Name --}}
                    <h2 class="card-title">{{ $class->name }}</h2>

                    {{-- Description --}}
                    <p class="card-description mt-2">
                        {{ $class->description ?? 'No description provided.' }}
                    </p>

                    {{-- Mini Stats --}}
                    <div class="mt-4 flex flex-col gap-2 text-sm class-meta">

                        <div class="flex items-center gap-2">
                            <span>📘</span>
                            {{ $class->assignments->count() }} Assignments
                        </div>

                        <div class="flex items-center gap-2">
                            <span>👥</span>
                            {{ $class->students->count() }} Students
                        </div>

                        <div class="flex items-center gap-2">
                            <span>🕒</span>
                            Updated {{ $class->updated_at->diffForHumans() }}
                        </div>

                    </div>

                    {{-- Join Code --}}
                    <p class="mt-5 font-semibold" style="color: var(--pink-dark);">
                        Join Code:
                        <span class="join-code-box">{{ $class->join_code }}</span>
                    </p>

                    {{-- Open Class Button --}}
                    <div class="mt-6">
                        <a href="{{ route('teacher.assignments.index', ['classroom' => $class]) }}"
                           class="btn-secondary">
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
