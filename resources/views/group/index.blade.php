@extends('layout.navbar')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-6 text-center">Groups</h1>

        <div class="mt-4 mb-6 text-center">
            <a href="{{ route('group.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-3xl mx-2">Join Group</a>
            <a href="{{ route('group.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-3xl mx-2">Create Group</a>
        </div>

        @if ($groups->isEmpty())
            <div class="text-center text-gray-500">
                <p>No groups available. You can create your own group or join an existing one.</p>
            </div>
        @endif

        @if ($groups->isNotEmpty())
        <div class="bg-white shadow-md rounded-lg overflow-hidden divide-y divide-gray-200">
            @foreach ($groups as $group)
                <div class="flex items-center p-4 hover:bg-gray-100 transition duration-300">
                    <img src="{{ asset('images/' . $group->foto) }}" alt="Group Image" class="w-12 h-12 rounded-full object-cover mr-4">
        
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold">{{ $group->name }}</h2>
                        <p class="text-gray-500 text-sm">{{ Str::limit($group->description, 50) }}</p>
                    </div>
        
                    @if ($group->isUserMember(auth()->id()))
                        <!-- Jika sudah menjadi member -->
                        <a href="{{ route('group.show', $group->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-3xl mx-2">
                            View
                        </a>
                    @else
                        <!-- Jika belum menjadi member -->
                        <a href="{{ route('group.join', $group->id) }}"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-3xl mx-2">
                            Join Group
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
        
        @endif
    </div>
@endsection
