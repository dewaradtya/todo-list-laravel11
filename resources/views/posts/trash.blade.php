@extends('layout.navbar')

@section('content')
    <div class="container mx-auto py-4">
        <!-- Navigation Buttons -->
        <div class="mb-3 flex justify-end">
            <a href="{{ route('posts.index') }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
        </div>

        <div class="mb-3 flex space-x-4">
            <a href="{{ route('posts.trash') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Semua</a>
            <a href="{{ route('posts.filtrasi', 1) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Berlangsung
                ({{ $ongoing }})</a>
            <a href="{{ route('posts.filtrasi', 0) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Selesai
                ({{ $completed }})</a>
        </div>

        <!-- Trash Posts Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4">
                <h6 class="text-xl font-semibold">Trash - Posts</h6>
            </div>

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 border border-green-300 rounded-lg mb-4" role="alert">
                    <div class="flex items-center">
                        <i class="fa-solid fa-trash-can w-5 h-5 text-green-500 mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if ($posts->isEmpty())
                <p class="text-center py-4">No posts in the trash.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul posts</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal pembuatan</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($posts as $row)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $row->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($row->status == 1)
                                            berlangsung
                                        @else
                                            selesai
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $row->created_at->format('j F Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <form action="{{ route('posts.restore', $row->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600"
                                                onclick="return confirm('Apakah Anda yakin ingin memulihkan posts ini?')"><i
                                                    class="fa-solid fa-trash-arrow-up"></i></button>
                                        </form>
                                        <form action="{{ route('posts.forceDelete', $row->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus secara permanen posts ini?')"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
