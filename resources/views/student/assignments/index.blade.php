<x-app-layout>

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            Assignments for {{ $classroom->name }}
        </h1>

        @foreach ($assignments as $assignment)
            <a href="{{ route('student.assignments.show', $assignment) }}"
               class="block bg-slate-800 text-white p-4 rounded mb-3 hover:bg-slate-700 transition">
                <h2 class="text-lg font-semibold">{{ $assignment->title }}</h2>
                <p class="text-gray-300">{{ $assignment->description }}</p>
            </a>
        @endforeach

    </div>

</x-app-layout>
