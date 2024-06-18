@extends('layout.navbar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Update posts</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.update', $posts->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Jenis posts</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Masukkan jenis posts" value="{{ $posts->title }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ $posts->status == '1' ? 'selected' : '' }}>berlangsung
                                    </option>
                                    <option value="0" {{ $posts->status == '0' ? 'selected' : '' }}>selesai
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection