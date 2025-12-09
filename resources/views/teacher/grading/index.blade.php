<x-app-layout>

    <x-slot name="header">
        <h2 class="page-title">Grading Panel</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto">

        {{-- Empty Message --}}
        @if($submissions->isEmpty())
            <p class="empty mt-4">No submissions to grade right now.</p>
        @endif

        <div class="space-y-6 mt-6">
            @foreach($submissions as $sub)
                <div class="card hover-grow">

                    {{-- Title --}}
                    <h3 class="card-title">
                        {{ $sub->assignment->title }}
                    </h3>

                    {{-- Student + Class --}}
                    <p class="card-description mt-2">
                        👤 <strong>{{ $sub->student->name }}</strong><br>
                        🏫 Class: <strong>{{ $sub->assignment->classroom->name }}</strong>
                    </p>

                    {{-- ⭐⭐ DOWNLOAD + GRADE IN ONE ROW ⭐⭐ --}}
                    <div class="submission-actions">

                        {{-- Download Button --}}
                        <a href="{{ asset('storage/' . $sub->file_path) }}" 
                           class="btn-secondary">
                            ⬇️ Download Submission
                        </a>

                        {{-- Grade Form --}}
                        <form action="{{ route('teacher.submissions.grade', $sub) }}"
                              method="POST" class="flex items-center gap-3">
                            @csrf

                            <select name="grade" class="grade-select">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>

                            <button type="submit" class="btn-primary">
                                💾 Save Grade
                            </button>
                        </form>

                    </div>

                </div>
            @endforeach
        </div>

    </div>

</x-app-layout>
