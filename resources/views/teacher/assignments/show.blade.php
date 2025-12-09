<x-app-layout>

    <x-slot name="header">
        <h2 class="page-title">{{ $assignment->title }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">

        {{-- Assignment Header Card --}}
        <div class="card hover-grow mb-8">

            <h2 class="card-title">{{ $assignment->title }}</h2>
            <p class="card-description">{{ $assignment->description }}</p>

            <div class="assignment-meta mt-4">
                <div>📅 Created {{ $assignment->created_at->diffForHumans() }}</div>
                <div>📌 Part of class: <strong>{{ $assignment->classroom->name }}</strong></div>
            </div>

            <div class="mt-6 flex gap-4">
                <a href="{{ route('teacher.assignments.edit', $assignment) }}" class="btn-secondary">
                    ✏️ Edit Assignment
                </a>

                <a href="{{ asset('storage/' . $assignment->file_path) }}" class="btn-primary" download>
                    ⬇️ Download Assignment File
                </a>
            </div>

        </div>


        {{-- Student Submissions --}}
        <h3 class="section-title mt-10">Student Submissions</h3>

        @if ($assignment->submissions->isEmpty())
            <p class="empty mt-2">No submissions yet.</p>
        @else
            @foreach ($assignment->submissions as $submission)
                <div class="card hover-grow mt-4">

                    <div class="mb-3">
                        <strong>{{ $submission->student->name }}</strong>
                        <p class="text-sm opacity-75">
                            Submitted: {{ $submission->created_at->format('M d, Y H:i') }}
                        </p>
                    </div>

                    {{-- Grade --}}
                    <p class="mb-4">
                        <strong>Grade:</strong>
                        @if($submission->grade)
                            {{ $submission->grade }}/10
                        @else
                            <span class="opacity-60">Not graded</span>
                        @endif
                    </p>


                    {{-- ✅ ACTIONS ROW — THIS IS THE FIXED PART --}}
                    <div class="flex items-center submission-actions">

                        {{-- Download Button --}}
                        <a href="{{ asset($submission->file_path) }}" download class="btn-secondary">
                            ⬇️ Download
                        </a>

                        {{-- Grade Form --}}
                        <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST" class="flex items-center">
                            @csrf

                            <select name="grade" class="grade-select">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ $submission->grade == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>

                            <button type="submit" class="btn-primary">
                                Grade
                            </button>
                        </form>

                    </div>
                    {{-- END ACTIONS ROW --}}

                </div>
            @endforeach
        @endif

    </div>

</x-app-layout>
