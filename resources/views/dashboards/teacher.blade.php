<x-app-layout>
    <div class="pink-theme p-8">

        <h1 class="page-title mb-2">Teacher Dashboard</h1>

        <p class="text-gray-800 mb-6 text-lg">
            Welcome, <strong>{{ auth()->user()->name }}</strong>!
        </p>

        <div class="card">
            <h2 class="card-title mb-3">What you can do</h2>

            <ul class="list-disc pl-6 text-gray-700">
                <li>Create and manage your classes</li>
                <li>Create assignments for students</li>
                <li>Review and grade student submissions</li>
            </ul>
        </div>

        <a href="{{ route('teacher.classes.index') }}" class="btn-primary mt-4 inline-block">
            Go to My Classes
        </a>

    </div>
</x-app-layout>
