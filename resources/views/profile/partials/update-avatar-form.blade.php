<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Picture
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Upload or remove your profile picture.
        </p>
    </header>

    {{-- Current Avatar Preview --}}
    <div class="mt-4">
        @if(Auth::user()->avatar)
            <img src="{{ asset('avatars/' . Auth::user()->avatar) }}"
                 class="w-24 h-24 rounded-full object-cover border">
        @else
            <p class="text-gray-500 text-sm">You have no profile picture yet.</p>
        @endif
    </div>

    {{-- Upload New Avatar --}}
    <form method="POST" action="{{ route('profile.avatar.upload') }}" enctype="multipart/form-data">
        @csrf

        <input type="file" name="avatar"
               class="block w-full text-sm text-gray-700 mt-2" required>

        <x-primary-button class="mt-3">
            Upload Avatar
        </x-primary-button>
    </form>

    {{-- Delete Avatar --}}
    @if(Auth::user()->avatar)
    <form method="POST" action="{{ route('profile.avatar.delete') }}" class="mt-3">
        @csrf
        @method('DELETE')

        <x-danger-button>
            Delete Avatar
        </x-danger-button>
    </form>
    @endif
</section>
