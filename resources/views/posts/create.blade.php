@extends('layout.navbar')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h6 class="text-xl font-bold text-gray-800 mb-4">Tambah Post</h6>
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Judul</label>
                        <input type="text" id="title" name="title" placeholder="Masukkan judul post"
                            class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('title') }}">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1">Berlangsung</option>
                            <option value="0">Selesai</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Simpan
                        </button>
                        <a href="{{ route('posts.index') }}"
                            class="ml-3 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
