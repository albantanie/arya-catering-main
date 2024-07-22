@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="background-color: #f3f4f5;">
    <div class="container">
        <!-- Add Menu Button -->
        <a href="{{ route('admin.menu.create') }}" class="btn btn-success mb-3">Tambah Menu</a>
        <hr>

        <!-- Search Form -->
        <div class="mb-4">
            <form action="{{ route('admin.menu.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for a menu item" value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <!-- Menu Items -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($menus as $menu)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="/storage/{{ $menu->image }}" class="card-img-top" alt="{{ $menu->name }}" style="object-fit: cover; height: 200px;">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-truncate">{{ $menu->name }}</h6>
                            <p class="card-text text-primary fw-bold mt-auto mb-2">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                            <div class="d-flex">
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                                <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No menus found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $menus->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<style>
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transition: box-shadow 0.3s ease-in-out;
    }
    .card-img-top {
        border-top-left-radius: calc(0.25rem - 1px);
        border-top-right-radius: calc(0.25rem - 1px);
    }
    .pagination {
        margin: 0;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .pagination .page-link {
        border-radius: 0.25rem;
    }
    .pagination .page-link, .pagination .page-item.disabled .page-link {
        color: #007bff;
        border-color: #dee2e6;
    }
    .search-form {
        max-width: 400px;
        margin: auto;
    }
</style>
@endsection
