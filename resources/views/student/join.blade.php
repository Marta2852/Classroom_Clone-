<x-app-layout>
    <div class="max-w-md mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Join a Class</h1>

        <form action="{{ route('student.join.submit') }}" method="POST">
            @csrf

            <label class="block font-semibold mb-2">Enter Join Code:</label>
            <input type="text" name="code" class="border p-2 rounded w-full">

            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                Join
            </button>
        </form>

    </div>
</x-app-layout>
