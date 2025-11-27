<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome, {{ auth()->user()->name }}!</p>

        <div class="mt-6">
            <ul class="list-disc pl-6 text-gray-700">
                <li>Manage users</li>
                <li>Assign teacher roles</li>
                <li>View system activity</li>
                <li>Manage classes</li>
            </ul>
        </div>
    </div>
</x-app-layout>
