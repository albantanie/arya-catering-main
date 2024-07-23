@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="container">
        <!-- Add Menu Button -->
        <a href="{{ route('admin.menu.create') }}" class="btn btn-success mb-3">Tambah Menu</a>

        <!-- Search Form -->
        <div class="mb-4">
            <form action="{{ route('admin.menu.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for a menu item" value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-outline-success border-1">Search</button>
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
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-primary btn-sm me-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('admin.menu.delete', $menu->id) }}')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
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

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
    .pagination .page-link {
        border-radius: 0.25rem;
    }
    .search-form {
        max-width: 400px;
        margin: auto;
    }
</style>

<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to delete this menu item?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'The menu item has been deleted.',
                    'success'
                ).then(() => {
                    window.location.href = url;
                });
            }
        });
    }
</script>
@endsection
