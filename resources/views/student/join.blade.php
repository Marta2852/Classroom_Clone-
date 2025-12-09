<x-app-layout>

    <div class="max-w-md mx-auto p-16 text-center">

        <h1 class="text-3xl font-bold mb-8" style="color: var(--color-accent);">
            Join a Class
        </h1>

        <form action="{{ route('student.join.submit') }}" method="POST" class="space-y-10">
            @csrf

            <input 
                type="text" 
                name="code"
                placeholder="Enter Join Code"
                class="w-full text-center text-xl py-3 bg-transparent border-b-2 focus:outline-none"
                style="border-color: var(--color-border); color: var(--color-text);"
                required
            >

            <button 
                class="btn-primary w-full py-3 text-lg font-semibold"
            >
                Join Class
            </button>
        </form>

    </div>

</x-app-layout>
