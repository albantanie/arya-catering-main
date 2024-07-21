@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.menu.create') }}" class="btn btn-success">Tambah Menu</a>
    <hr>
    <div class="row">
        @foreach ($menus as $menu)
            <div class="col-md-3 mb-2">
                <div class="card">
                    <img src="/storage/{{$menu->image }}" class="card-img-top" alt="..." style="aspect-ratio: 2/1">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('admin.menu.delete', $menu->id) }}" onclick="return confirm('Delete?')" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
