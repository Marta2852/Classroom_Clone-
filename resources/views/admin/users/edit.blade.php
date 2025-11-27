<x-app-layout>
    <div class="p-6 max-w-lg">

        <h1 class="text-2xl font-bold mb-4">Edit User</h1>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')   <!-- THIS IS THE IMPORTANT PART -->

            <label class="block mb-3">
                Name:
                <input type="text" name="name" class="w-full border p-2" value="{{ $user->name }}" required>
            </label>

            <label class="block mb-3">
                Email:
                <input type="email" name="email" class="w-full border p-2" value="{{ $user->email }}" required>
            </label>

            <label class="block mb-3">
                Role:
                <select name="role" class="w-full border p-2">
                    <option value="admin" @selected($user->role=='admin')>Admin</option>
                    <option value="teacher" @selected($user->role=='teacher')>Teacher</option>
                    <option value="student" @selected($user->role=='student')>Student</option>
                </select>
            </label>

            <label class="block mb-3">
                New Password (optional):
                <input type="password" name="password" class="w-full border p-2">
            </label>

            <button class="bg-blue-600 text-white px-4 py-2 mt-3">Save</button>
        </form>
    </div>
</x-app-layout>
