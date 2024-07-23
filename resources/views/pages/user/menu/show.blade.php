@extends('layouts.user')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <img src="/storage/{{ $menu->image }}" class="img-fluid" alt="{{ $menu->name }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $menu->name }}</h1>
            <p class="text-primary fw-bold">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
            <p>{{ $menu->description }}</p>
            <form id="add-to-cart-form" action="{{ route('user.cart.add') }}" method="POST">
                @csrf
                @auth
                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                @endauth
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <div class="d-flex align-items-center">
                    <input type="number" name="amount" class="form-control me-2" min="1" placeholder="Qty" required>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-cart-plus me-1"></i> Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('add-to-cart-form');
        
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan barang ini ke keranjang?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tambah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil', 'Barang berhasil ditambahkan ke keranjang', 'success')
                        .then(() => {
                            form.submit();
                        });
                }
            });
        });

    });
</script>

@endsection
