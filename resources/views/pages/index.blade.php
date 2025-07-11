@extends('layouts.user')

@section('content')
<div class="container-fluid py-4">
    <div class="container">
        <!-- Search Form -->
        <div class="mb-4">
            <form action="{{ route('user.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <form class="d-flex mx-auto" action="{{route('user.index')}}" role="search">
                        <input class="form-control" type="search" placeholder="Search for a menu item" aria-label="Search">
                        <button class="btn btn-outline-success" value="{{ request('search') }}" type="submit">Search</button>
                    </form>
                </div>
            </form>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($menus as $menu)
                <div class="col">
                    <div class="card h-100 border-0 shadow">
                        <img src="/storage/{{ $menu->image }}" class="card-img-top" alt="{{ $menu->name }}" style="object-fit: cover; height: 200px;">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-truncate">{{ $menu->name }}</h6>
                            <p class="card-text text-primary fw-bold mt-auto mb-2">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                            <form class="add-to-cart-form" action="{{ route('user.cart.add') }}" method="POST">
                                @csrf
                                @auth
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                                @endauth
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <div class="d-flex align-items-center">
                                    <input type="number" name="amount" class="form-control form-control-sm me-2" min="1" placeholder="Qty" required>
                                    <button type="submit" class="btn btn-sm btn-success flex-grow-1">
                                        <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
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
      
    }
    .pagination .page-link {
        border-radius: 0.25rem;
    }
    .pagination .page-link, .pagination .page-item.disabled .page-link {
       
    }
    .search-form {
        max-width: 400px;
        margin: auto;
    }
</style>

@if (!auth()->check())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cartForms = document.querySelectorAll('.add-to-cart-form');
            const searchForm = document.querySelector('.search-form');

            // Handle cart forms submission
            cartForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Login Required',
                        text: 'You need to log in first',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Login',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(window.location.href);
                        }
                    });
                });
            });

            // Handle search form submission
            searchForm.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Login Required',
                    text: 'You need to log in first',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Login',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(window.location.href);
                    }
                });
            });
        });
    </script>
@endif

@endsection
