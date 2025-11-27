<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold">User Management</h1>

        <table class="mt-6 w-full border-collapse">
            <tr class="border-b">
                <th class="p-2 text-left">Name</th>
                <th class="p-2 text-left">Email</th>
                <th class="p-2 text-left">Role</th>
                <th class="p-2">Actions</th>
            </tr>

            @foreach($users as $user)
                <tr class="border-b">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->role }}</td>
                    <td class="p-2 flex gap-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
