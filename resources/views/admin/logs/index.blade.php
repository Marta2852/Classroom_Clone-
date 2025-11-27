<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Admin Action History</h1>

        <table class="w-full border-collapse">
            @foreach($logs as $log)
                <tr class="border-b">
                    <td class="p-2 text-gray-700">
                        <strong>{{ $log->admin->name }}</strong>
                        performed action:
                        <em>{{ $log->action }}</em>
                        <br>
                        <span class="text-sm text-gray-500">{{ $log->created_at->diffForHumans() }}</span>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $logs->links() }}
    </div>
</x-app-layout>
