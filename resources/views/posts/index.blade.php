@extends('layout.navbar')

@section('content')
    <div class="container mx-auto py-6">
        <!-- Action Buttons -->
        <div class="flex justify-between mb-6">
            <a href="{{ route('posts.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded"><i
                    class="fa-solid fa-plus"></i></a>
            <a href="{{ route('posts.trash') }}"
                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">Tempat Sampah</a>
        </div>

        <!-- Filter Buttons -->
        <div class="flex justify-start mb-6 space-x-4">
            <a href="{{ route('posts.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Semua</a>
            <a href="{{ route('posts.filter', 1) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                <i class="fa-solid fa-gears"></i> ({{ $ongoingCount }})
            </a>
            <a href="{{ route('posts.filter', 0) }}"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                <i class="fa-solid fa-clipboard-check"></i> ({{ $completedCount }})
            </a>
        </div>

        <!-- Tasks Table -->
        <div class="bg-white shadow-md rounded-lg">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 border border-green-300 rounded-lg mb-4" role="alert">
                    <div class="flex items-center">
                        <i class="fa-solid fa-check w-5 h-5 mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if ($posts->isEmpty())
                <p class="text-center py-4 text-gray-500">No tasks available.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">#</th>
                                <th class="py-3 px-6 text-left">Judul Task</th>
                                <th class="py-3 px-6 text-left">Deskripsi</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Tanggal Pembuatan</th>
                                <th class="py-3 px-6 text-center">Jatuh Tempo</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @foreach ($posts as $row)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-6">{{ $row->title }}</td>
                                    <td class="py-3 px-6">{{ $row->description }}</td>
                                    <td class="py-3 px-6 text-center">
                                        @if ($row->status == 1)
                                            <span
                                                class="bg-yellow-500 text-white py-1 px-3 rounded-full text-xs">Berlangsung</span>
                                        @else
                                            <span
                                                class="bg-green-500 text-white py-1 px-3 rounded-full text-xs">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">{{ $row->created_at->format('j F Y') }}</td>
                                    <td class="py-3 px-6 text-center">
                                        {{ \Carbon\Carbon::parse($row->due_date)->format('j F Y') }}
                                    </td>
                                    <td class="py-3 px-6 text-center flex space-x-2 justify-center">
                                        <a href="{{ route('posts.edit', $row->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded"><i
                                                class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('posts.destroy', $row->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus task ini?')"><i
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
