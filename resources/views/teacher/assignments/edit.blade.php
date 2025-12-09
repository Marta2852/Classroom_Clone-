<x-app-layout>

    <x-slot name="header">
        <h2 class="page-title">✏️ Edit: {{ $assignment->title }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">

        <div class="form-card">

            <h3 class="form-title">Edit Assignment</h3>

            <form action="{{ route('teacher.assignments.update', $assignment) }}" 
                  method="POST" 
                  enctype="multipart/form-data">

                @csrf

                {{-- TITLE FIELD --}}
                <div class="form-section">
                    <label class="form-label">Title</label>
                    <input type="text" 
                           name="title" 
                           value="{{ $assignment->title }}" 
                           class="form-input">
                </div>

                {{-- DESCRIPTION FIELD --}}
                <div class="form-section">
                    <label class="form-label">Description</label>
                    <textarea name="description" 
                              rows="4" 
                              class="form-textarea">{{ $assignment->description }}</textarea>
                </div>

                {{-- CURRENT FILE --}}
                <div class="form-section">
                    <label class="form-label">Current File</label>

                    @if($assignment->file_path)
                        <a href="{{ asset('storage/' . $assignment->file_path) }}" class="btn-secondary download-box">
                            ⬇️ Download Existing File
                        </a>
                    @else
                        <p class="opacity-60 text-sm">No file uploaded.</p>
                    @endif
                </div>

                {{-- FILE REPLACEMENT --}}
                <div class="form-section">
                    <label class="form-label">Replace File <span class="opacity-60">(optional)</span></label>
                    <input type="file" name="file" class="form-input">
                </div>

                {{-- BUTTONS --}}
                <div class="form-buttons">
                    <button type="submit" class="btn-primary px-6 py-2">
                        💾 Save Changes
                    </button>

                    <a href="{{ route('teacher.assignments.show', $assignment) }}" class="btn-secondary px-6 py-2">
                        ❌ Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
