<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold">Teacher Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome, {{ auth()->user()->name }}!</p>

        <div class="mt-6">
            <ul class="list-disc pl-6 text-gray-700">
                <li>Create and manage classes</li>
                <li>Create assignments</li>
                <li>Review student submissions</li>
            </ul>
        </div>
    </div>
</x-app-layout>
