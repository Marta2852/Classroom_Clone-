<x-app-layout>
    <div class="max-w-5xl mx-auto p-8">

        <h1 class="text-3xl font-bold text-pink-900 mb-6 flex items-center gap-2">
            👥 User Management
        </h1>

        <table class="admin-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>

                <td>
                    <div class="admin-actions">
                        <a class="admin-btn-edit" href="{{ route('admin.users.edit', $user) }}">
                            ✏️ Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.users.destroy', $user) }}"
                              onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button class="admin-btn-delete">🗑 Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


    </div>
</x-app-layout>
