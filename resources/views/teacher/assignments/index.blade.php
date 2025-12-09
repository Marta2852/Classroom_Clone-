<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-3xl font-bold text-pink-900 mb-6">
            Assignments for {{ $classroom->name }}
        </h1>

        <a href="{{ route('teacher.assignments.create', $classroom) }}"
           class="bg-pink-700 text-white px-4 py-2 rounded hover:bg-pink-800 mb-4 inline-block">
            + Create Assignment
        </a>

        <div class="space-y-4 mt-6">
            @foreach($assignments as $a)
                <a href="{{ route('teacher.assignments.show', $a) }}"
                   class="block p-4 bg-white border border-pink-300 rounded-xl shadow hover:bg-pink-100">
                    <h2 class="text-xl font-bold text-pink-900">{{ $a->title }}</h2>
                    <p class="text-gray-700">{{ $a->description }}</p>
                </a>
            @endforeach
        </div>

    </div>
</x-app-layout>
