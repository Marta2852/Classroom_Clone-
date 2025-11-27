<x-app-layout>
    <div class="p-6 max-w-lg mx-auto">

        <h1 class="text-3xl font-bold mb-4">
            Create Assignment for {{ $classroom->name }}
        </h1>

        <form action="{{ route('teacher.assignments.store', $classroom) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-4">

            @csrf

            <div>
                <label class="block font-semibold">Title:</label>
                <input type="text" name="title" required
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-semibold">Description:</label>
                <textarea name="description" class="w-full border p-2 rounded"></textarea>
            </div>

            <div>
                <label class="block font-semibold">Attach File (optional):</label>
                <input type="file" name="file" class="w-full border p-2 rounded">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Create Assignment
            </button>
        </form>

    </div>
</x-app-layout>
