@extends('layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="col-md-5">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Nama Menu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="name">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $menu->description }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $menu->price }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="image">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
@endsection
