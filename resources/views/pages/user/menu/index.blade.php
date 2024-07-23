@extends('layouts.user')

@section('content')
<div class="container-fluid py-4">
    <div class="container">
        <!-- Search Form -->
        <div class="mb-4">
            <form action="{{ route('user.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Search for a menu item" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-success border-1">Search</button>
                </div>
            </form>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($menus as $menu)
                <div class="col">
                    <div class="card h-100 shadow">
                        <a href="{{ route('user.menu.show', $menu->id) }}" class="stretched-link"></a>
                        <img src="/storage/{{ $menu->image }}" class="card-img-top" alt="{{ $menu->name }}" style="object-fit: cover; height: 200px;">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-truncate">{{ $menu->name }}</h6>
                            <p class="card-text text-primary fw-bold mt-auto mb-2">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $menus->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        position: relative;
    }
    .card:hover {
        box-shadow: 0 0.15rem 0.75rem rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
    }
    .card-img-top {
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }
    .pagination {
        margin: 0;
    }
    .pagination .page-item.active .page-link {
       
    }
    .pagination .page-link {
        border-radius: 0.25rem;
    }
    .pagination .page-link,
    .pagination .page-item.disabled .page-link {
       
    }
    .search-form {
        max-width: 400px;
        margin: auto;
    }
    .stretched-link {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
    }
</style>

@if (!auth()->check())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cartForms = document.querySelectorAll('.add-to-cart-form');
            cartForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    // Redirect to login with a message
                    window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(window.location.href) + "&message=You need to log in first.";
                });
            });
        });
    </script>
@endif

@endsection
