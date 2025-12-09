<x-app-layout>

    <div class="pink-theme p-6">

        <h1 class="page-title">{{ $assignment->title }}</h1>
        <p class="text-gray-700 mt-2">{{ $assignment->description }}</p>

        <!-- Download Assignment File -->
        @if($assignment->file_path)
            <a href="{{ asset('storage/' . $assignment->file_path) }}"
               download
               class="btn-primary mt-4 inline-block">
                📄 Download Assignment File
            </a>
        @endif


        <!-- Submissions List -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-pink-900">Student Submissions</h2>

            @if($assignment->submissions->count() === 0)
                <p class="text-gray-600 mt-3">
                    No students have submitted this assignment yet.
                </p>
            @else

                <div class="mt-4 space-y-4">

                    @foreach($assignment->submissions as $submission)
                        <div class="card">

                            <div class="flex justify-between items-center">

                                <div>
                                    <p class="font-semibold text-pink-900">
                                        {{ $submission->student->name }}
                                    </p>

                                    <p class="text-gray-600 text-sm">
                                        Submitted: {{ $submission->created_at->format('M d, Y H:i') }}
                                    </p>

                                    @if($submission->grade)
                                        <p class="text-green-700 font-bold mt-1">
                                            Grade: {{ $submission->grade }}/10
                                        </p>
                                    @else
                                        <p class="text-yellow-700 font-bold mt-1">
                                            Not graded yet
                                        </p>
                                    @endif
                                </div>

                                <div class="flex space-x-3">

                                    <!-- Download Submission -->
                                    <a href="{{ asset('storage/' . $submission->file_path) }}"
                                       download
                                       class="btn-secondary">
                                        ⬇ Download
                                    </a>

                                    <!-- Grade Form -->
                                    <form action="{{ route('teacher.submissions.grade', $submission) }}"
                                          method="POST"
                                          class="flex items-center space-x-2">
                                        @csrf

                                        <input type="number"
                                               name="grade"
                                               min="1"
                                               max="10"
                                               class="border border-pink-300 rounded px-2 py-1 w-20"
                                               placeholder="1–10">

                                        <button class="btn-primary">
                                            Grade
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @endif

        </div>

    </div>

</x-app-layout>
