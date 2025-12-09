<x-app-layout>

    <x-slot name="header">
        <h2 class="page-title">➕ Create Assignment for {{ $classroom->name }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">

        <div class="form-card">

            <h3 class="form-title">New Assignment</h3>

            <form action="{{ route('teacher.assignments.store', $classroom) }}" 
                  method="POST" 
                  enctype="multipart/form-data">

                @csrf

                {{-- TITLE --}}
                <div class="form-section">
                    <label class="form-label">Title</label>
                    <input type="text" 
                           name="title" 
                           placeholder="Enter assignment title"
                           class="form-input" required>
                </div>

                {{-- DESCRIPTION --}}
                <div class="form-section">
                    <label class="form-label">Description</label>
                    <textarea name="description" 
                              rows="4"
                              placeholder="Describe the assignment..."
                              class="form-textarea"></textarea>
                </div>

                {{-- FILE UPLOAD --}}
                <div class="form-section">
                    <label class="form-label">Attach File <span class="opacity-60">(optional)</span></label>
                    <input type="file" name="file" class="form-input">
                </div>

                {{-- BUTTONS --}}
                <div class="form-buttons">
                    <button type="submit" class="btn-primary px-6 py-2">
                        ➕ Create Assignment
                    </button>

                    <a href="{{ route('teacher.assignments.index', $classroom) }}" 
                       class="btn-secondary px-6 py-2">
                        ❌ Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
