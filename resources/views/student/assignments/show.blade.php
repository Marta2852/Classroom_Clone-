<x-app-layout>

    <div class="max-w-2xl mx-auto p-6">

        {{-- CLEAN HEADER (NO BOX) --}}
        <h1 class="text-3xl font-bold mb-2">{{ $assignment->title }}</h1>
        <p class="opacity-80 mb-4">{{ $assignment->description }}</p>

        @if($assignment->file_path)
            <a href="{{ Storage::url($assignment->file_path) }}"
               class="btn-secondary inline-flex items-center mb-6"
               download>
                ⬇️ Download Assignment File
            </a>
        @endif


        {{-- Submit Box --}}
        <h2 class="section-title mb-3">📤 Submit Your Work</h2>

        <div class="card hover-grow mb-10" style="padding: 22px;">
            <form action="{{ route('student.assignments.submit', $assignment) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <label class="form-label mb-1">Upload File</label>
                <input type="file" name="file" class="form-input mb-4" required>

                <label class="form-label mb-1">Comment (optional)</label>
                <textarea name="comment" rows="3" class="form-textarea mb-4"></textarea>

                <button class="btn-primary px-5 py-2">
                    📤 Submit Assignment
                </button>
            </form>
        </div>


        {{-- Past Submissions --}}
        @php
            $mySubmissions = $assignment->submissions()
                ->where('student_id', auth()->id())
                ->latest()
                ->get();
        @endphp

        @if($mySubmissions->count() > 0)
            
            <h2 class="section-title mb-3">📚 Your Submissions</h2>

            <div class="space-y-4">

                @foreach($mySubmissions as $sub)
                    <div class="card hover-grow p-4">

                        <p class="opacity-75 text-sm mb-2">
                            Submitted on <strong>{{ $sub->created_at->format('M d, Y H:i') }}</strong>
                        </p>

                        <a href="{{ Storage::url($sub->file_path) }}"
                           class="btn-secondary inline-flex items-center mb-2"
                           download>
                            ⬇️ Download Submitted File
                        </a>

                        @if($sub->comment)
                            <p class="italic opacity-75 mb-1">
                                💬 {{ $sub->comment }}
                            </p>
                        @endif

                        @if($sub->grade !== null)
                            <p class="font-bold" style="color: green;">
                                ⭐ Grade: {{ $sub->grade }} / 10
                            </p>
                        @else
                            <p class="opacity-70">Not graded yet</p>
                        @endif

                    </div>
                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>
