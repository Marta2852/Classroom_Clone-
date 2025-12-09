<x-app-layout>
    <div class="pink-theme p-6">
        <h1 class="page-title">My Classes</h1>

        @foreach($classes as $class)
            <div class="card mt-6">
                <h2 class="card-title">{{ $class->name }}</h2>
                <p class="card-description">{{ $class->description }}</p>

                <a class="btn-secondary mt-4 inline-block"
                   href="{{ route('student.assignments.index', $class->id) }}">
                    View Assignments
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>
