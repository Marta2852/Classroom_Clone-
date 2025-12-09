<x-app-layout>

    <x-slot name="header">
        <h2 class="page-title">➕ Create New Class</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">

        <div class="form-card">

            <h3 class="form-title">New Class</h3>

            <form action="{{ route('teacher.classes.store') }}" method="POST">
                @csrf

                {{-- CLASS NAME --}}
                <div class="form-section">
                    <label class="form-label">Class Name</label>
                    <input type="text" 
                           name="name" 
                           placeholder="Enter class name"
                           class="form-input" 
                           required>
                </div>

                {{-- DESCRIPTION --}}
                <div class="form-section">
                    <label class="form-label">Description</label>
                    <textarea name="description" 
                              rows="3"
                              placeholder="Describe the class..."
                              class="form-textarea"></textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="form-buttons">
                    <button type="submit" class="btn-primary px-6 py-2">
                        ➕ Create Class
                    </button>

                    <a href="{{ route('teacher.classes.index') }}" 
                       class="btn-secondary px-6 py-2">
                        ❌ Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
