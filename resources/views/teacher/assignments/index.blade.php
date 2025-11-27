<x-app-layout>
    <div class="p-6">

        <h1 class="text-3xl font-bold">
            Assignments for {{ $classroom->name }}
        </h1>

        <a href="{{ route('teacher.assignments.create', $classroom) }}"
           class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
            + Create Assignment
        </a>

        <div class="mt-6 space-y-4">
            @forelse ($assignments as $assignment)
                <a href="{{ route('teacher.assignments.show', $assignment) }}"
                   class="block p-4 rounded border bg-white dark:bg-gray-800 shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <h2 class="text-xl font-semibold">{{ $assignment->title }}</h2>
                    <p class="text-gray-500">{{ $assignment->description }}</p>
                </a>
            @empty
                <p class="text-gray-500 mt-4">No assignments yet.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
