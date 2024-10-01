@extends('layout.navbar')

@section('content')
    <div class="p-6 max-w-2xl mx-auto bg-white rounded-lg shadow-lg mt-2">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Profile</h1>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Name</label>
                <input type="text" name="name" value="{{ $user->name }}"
                    class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                    class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-600 font-semibold mb-2">Profile Picture</label>
                <div class="flex items-center space-x-6">
                    @if ($user->foto)
                        <img src="{{ asset('images/' . $user->foto) }}" alt="Profile Picture"
                            class="h-24 w-24 rounded-full object-cover border border-gray-300 shadow-sm">
                    @else
                        <img src="{{ asset('images/default-profile.jpg') }}" alt="Default Profile Picture"
                            class="h-24 w-24 rounded-full object-cover border border-gray-300 shadow-sm">
                    @endif
                    <input type="file" name="foto"
                        class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('foto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="bg-blue-500 text-white px-8 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 mr-2 focus:ring-blue-500">
                    Save Changes
                </button>
                <a href="{{ route('profile.show') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-3xl hover:bg-yellow-600 mr-2">
                   kembali
                </a>
            </div>
        </form>
    </div>
@endsection
