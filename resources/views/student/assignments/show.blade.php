<x-app-layout>

    <div class="max-w-3xl mx-auto p-6 text-white">

        <!-- Assignment Header -->
        <h1 class="text-3xl font-bold mb-2">{{ $assignment->title }}</h1>
        <p class="text-gray-300 mb-6">{{ $assignment->description }}</p>

        <!-- Teacher File -->
        @if($assignment->file_path)
            <div class="mb-6 p-4 bg-slate-800 rounded">
                <p class="font-semibold text-gray-200 mb-2">Attached File:</p>
                <a href="{{ Storage::url($assignment->file_path) }}"
                   class="text-blue-400 underline"
                   download>
                    Download Assignment File
                </a>
            </div>
        @endif

        <!-- Submit Box -->
        <div class="bg-slate-900 p-6 rounded shadow">

            <h2 class="text-xl font-bold mb-4">Submit Your Work</h2>

            <form action="{{ route('student.assignments.submit', $assignment) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <label class="block mb-2 font-semibold">Upload File:</label>
                <input type="file" name="file"
                       class="w-full border p-2 rounded bg-slate-800 text-white"
                       required>

                <label class="block mt-4 mb-2 font-semibold">Comment (optional):</label>
                <textarea name="comment"
                          class="w-full border p-2 rounded bg-slate-800 text-white"
                          rows="3"></textarea>

                <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Submit Assignment
                </button>

            </form>

        </div>


        <!-- Previous Submissions (optional) -->
        @php
            $mySubmissions = $assignment->submissions()
                ->where('student_id', auth()->id())
                ->latest()
                ->get();
        @endphp

        @if($mySubmissions->count() > 0)
            <div class="mt-10">
                <h2 class="text-xl font-bold mb-4">Your Submissions</h2>

                @foreach($mySubmissions as $sub)
                    <div class="bg-slate-800 p-4 rounded mb-3">
                        <p class="text-gray-300">
                            Submitted on: {{ $sub->created_at->format('Y-m-d H:i') }}
                        </p>

                        <a href="{{ Storage::url($sub->file_path) }}"
                           class="text-blue-400 underline block mt-2"
                           download>
                            Download Submitted File
                        </a>

                        @if($sub->comment)
                            <p class="text-gray-400 mt-2 italic">
                                Comment: {{ $sub->comment }}
                            </p>
                        @endif

                        @if($sub->grade !== null)
                            <p class="mt-2 font-semibold text-green-400">
                                Grade: {{ $sub->grade }} / 100
                            </p>
                        @else
                            <p class="mt-2 text-gray-400">Not graded yet</p>
                        @endif
                    </div>
                @endforeach

            </div>
        @endif

    </div>

</x-app-layout>
