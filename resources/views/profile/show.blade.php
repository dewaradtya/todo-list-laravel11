@extends('layout.navbar')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex flex-col items-center">
            <div class="flex items-center space-x-6 mb-6">
                <div class="relative">
                    <img src="{{ asset('images/' . $user->foto) }}" alt="Profile Picture"
                        class="h-32 w-32 rounded-full object-cover border-4 border-gray-200">
                </div>
                <div class="text-start">
                    <h1 class="text-3xl font-bold mb-2">{{ $user->name }}</h1>
                    <p class="text-lg text-gray-600 mb-2">{{ $user->email }}</p>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded-3xl hover:bg-blue-600 mr-2">
                            Edit Profile
                        </a>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <h2 class="text-2xl font-semibold mb-4">Group</h2>
                <div class="grid grid-cols-3 gap-4">
                    @for ($i = 0; $i < 9; $i++)
                        <div class="relative h-40 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="post-placeholder.jpg" alt="Post Image" class="object-cover w-full h-full">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
