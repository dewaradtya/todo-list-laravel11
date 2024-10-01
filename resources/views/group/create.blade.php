@extends('layout.navbar')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-semibold mb-6 text-center">Create a New Group</h1>

        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-3 border border-red-300 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Group creation form -->
        <form action="{{ route('group.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Group Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Group Description</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Group Photo</label>
                <input type="file" name="foto" id="foto" class="mt-1 block w-full">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                    Create Group
                </button>
            </div>
        </form>
    </div>
@endsection
