@extends('layout.navbar')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-lg-12">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Tambah posts</a>
            <a href="{{ route('posts.trash') }}" class="btn btn-danger">Tempat Sampah</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Semua</a>
            <a href="{{ route('posts.filter', 1) }}" class="btn btn-primary">Berlangsung ({{ $ongoingCount }})</a>
            <a href="{{ route('posts.filter', 0) }}" class="btn btn-primary">Selesai ({{ $completedCount }})</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>posts</h6>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-light" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="ni ni-check-bold mr-2"></i>
                            <span>{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if($posts->isEmpty())
                    <p class="text-center">Nothing to post.</p>
                @else
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul posts</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal pembuatan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td class="text-center">
                                            @if ($row->status == 1)
                                                berlangsung
                                            @else
                                                selesai
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $row->created_at->format('j F Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('posts.edit', $row->id) }}" class="btn btn-primary btn">Edit</a>
                                            <form action="{{ route('posts.destroy', $row->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn" onclick="return confirm('Apakah Anda yakin ingin menghapus posts ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection