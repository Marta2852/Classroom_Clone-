<x-app-layout>
    <div class="p-6 max-w-lg mx-auto">

        <h1 class="text-2xl font-bold mb-4">Create New Class</h1>

        <form action="{{ route('teacher.classes.store') }}" method="POST">
            @csrf

            <label class="block mb-3">
                Class Name:
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </label>

            <label class="block mb-3">
                Description:
                <textarea name="description" class="w-full border p-2 rounded"></textarea>
            </label>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Create Class
            </button>
        </form>
    </div>
</x-app-layout>
