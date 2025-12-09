<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-3xl font-bold text-pink-900 mb-6">
            Grading Panel
        </h1>

        @if($submissions->isEmpty())
            <p class="text-gray-700">No submissions to grade right now.</p>
        @endif

        @foreach($submissions as $sub)
            <div class="p-4 mb-4 bg-white border border-pink-300 rounded-xl shadow">

                <h2 class="text-xl font-semibold text-pink-900">
                    {{ $sub->assignment->title }}
                </h2>

                <p class="text-gray-700">
                    Student: <strong>{{ $sub->student->name }}</strong>
                </p>

                <p class="text-gray-700">
                    Class: <strong>{{ $sub->assignment->classroom->name }}</strong>
                </p>

                @if($sub->file_path)
                    <a href="{{ asset('storage/' . $sub->file_path) }}"
                       class="text-pink-700 underline block mt-2">
                        Download Submission
                    </a>
                @endif

                <form action="{{ route('teacher.submissions.grade', $sub) }}"
                      method="POST" class="mt-3 flex items-center gap-2">
                    @csrf

                    <input type="number" name="grade" min="0" max="100"
                           class="border-pink-300 rounded w-20"
                           placeholder="Grade">

                    <button class="bg-pink-700 text-white px-3 py-1 rounded hover:bg-pink-800">
                        Save Grade
                    </button>
                </form>

            </div>
        @endforeach

    </div>
</x-app-layout>
