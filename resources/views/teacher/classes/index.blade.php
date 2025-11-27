<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold">My Classes</h1>

        <a href="{{ route('teacher.classes.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
            Create New Class
        </a>

        <div class="mt-6">
            @foreach ($classes as $class)
                <a href="{{ route('teacher.assignments.index', $class) }}"
                   class="block p-6 rounded bg-slate-900 text-white hover:bg-slate-800 transition mb-4">

                    <h2 class="text-xl font-semibold">{{ $class->name }}</h2>
                    <p class="text-gray-300">{{ $class->description }}</p>

                    <p class="mt-2 text-gray-400">
                        Join Code: <strong>{{ $class->join_code }}</strong>
                    </p>

                    <div class="mt-3">
                        <img 
                     src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('join.qr', $class->join_code)) }}"
                     class="mt-2 border rounded bg-white"
                    />


                    </div>

                    <p class="mt-3 text-sm text-gray-300 italic">
                        Click anywhere on this card to open the class & assignments →
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
