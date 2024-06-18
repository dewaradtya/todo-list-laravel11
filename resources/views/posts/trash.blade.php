@extends('layout.navbar')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-lg-12">
            <a href="{{ route('posts.index') }}" class="btn btn-warning">Kembali ke daftar posts</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <a href="{{ route('posts.trash') }}" class="btn btn-primary">Semua</a>
            <a href="{{ route('posts.filtrasi', 1) }}" class="btn btn-primary">Berlangsung ({{ $ongoing }})</a>
            <a href="{{ route('posts.filtrasi', 0) }}" class="btn btn-primary">Selesai ({{ $completed }})</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Trash - Posts</h6>
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
                    <p class="text-center">No posts in the trash.</p>
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
                                            <td>
                                                @if ($row->status == 1)
                                                    berlangsung
                                                @else
                                                    selesai
                                                @endif
                                            </td>
                                            <td>{{ $row->created_at->format('j F Y') }}</td>
                                            <td class="align-middle">
                                                <form action="{{ route('posts.restore', $row->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin memulihkan posts ini?')">Pulihkan</button>
                                                </form>
                                                <form action="{{ route('posts.forceDelete', $row->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus secara permanen posts ini?')">Hapus Permanen</button>
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
