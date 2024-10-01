@extends('layout.navbar')

@section('content')
    <div class="container mx-auto py-6">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-semibold">{{ $group->name }}</h1>
            <p class="text-gray-600">{{ $group->description }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Group Members</h2>

            @if ($groupMember->isEmpty())
                <p class="text-gray-500">No members in this group yet.</p>
            @else
                <div class="bg-white shadow-md rounded-lg overflow-hidden divide-y divide-gray-200">
                    @foreach ($groupMember as $member)
                        <div class="flex items-center p-4 hover:bg-gray-100 transition duration-300">
                            <img src="{{ asset('images/' . $member->user->profile_photo) }}" alt="User Image"
                                class="w-10 h-10 rounded-full object-cover mr-4">

                            <div class="flex-1">
                                <h2 class="text-lg font-semibold">{{ $member->user->name }}</h2>
                                <p class="text-gray-500 text-sm">{{ $member->role }}</p>
                                @if (!$member->is_confirmed)
                                    <span class="text-red-500">Pending Confirmation</span>
                                    @if (auth()->id() === $group->created_by)
                                        <!-- Tampilkan hanya untuk pembuat grup -->
                                        <form action="{{ route('group.confirm', [$group->id, $member->user_id]) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">Confirm</button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-green-500">Confirmed</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="text-center">
            <a href="{{ route('group.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-3xl mx-2">Back to Groups</a>
        </div>
    </div>
@endsection
