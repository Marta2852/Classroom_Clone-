<x-app-layout>
    <div class="p-6">

        <!-- Assignment Header -->
        <h1 class="text-3xl font-bold">{{ $assignment->title }}</h1>

        <p class="mt-2 text-gray-600 dark:text-gray-300">
            {{ $assignment->description }}
        </p>

        @if($assignment->file_path)
            <a href="{{ asset('storage/' . $assignment->file_path) }}"
               class="mt-4 inline-block bg-gray-700 text-white px-4 py-2 rounded">
                Download Attached File
            </a>
        @endif


        <!-- Submissions Section -->
        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Student Submissions</h2>

            @forelse($assignment->submissions as $submission)
                <div class="p-4 border rounded bg-white dark:bg-gray-800 mb-4">

                    <p class="font-semibold">
                        {{ $submission->student->name }}
                        <span class="text-gray-400">({{ $submission->student->email }})</span>
                    </p>

                    @if($submission->comment)
                        <p class="mt-2 text-gray-300 italic">
                            Student comment: "{{ $submission->comment }}"
                        </p>
                    @endif

                    <a href="{{ asset('storage/' . $submission->file_path) }}"
                       class="text-blue-600 underline block mt-2">
                        Download Submission
                    </a>
                    
                    <!-- Grading Form -->
                    <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST" class="mt-3 inline-flex items-center gap-2">
                        @csrf

                        <input type="number" 
                               name="grade" 
                               min="0" max="100"
                               value="{{ $submission->grade }}"
                               class="border p-2 rounded w-24">

                        <button class="bg-blue-600 text-white px-3 py-1 rounded">
                            Save Grade
                        </button>
                    </form>

                </div>

            @empty
                <p class="text-gray-500">No submissions yet.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
