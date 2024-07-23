@extends('layouts.user')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 d-flex flex-column align-items-center">
            <div class="text-center mb-4">
                <img src="/storage/{{ $menu->image }}" class="img-fluid" alt="{{ $menu->name }}">
            </div>
            <h1 class="text-center">{{ $menu->name }}</h1>
            <p class="text-primary fw-bold text-center">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
            <p class="text-center">{{ $menu->description }}</p>
            <form id="add-to-cart-form" action="{{ route('user.cart.add') }}" method="POST" class="d-flex flex-column align-items-center">
                @csrf
                @auth
                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                @endauth
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <div class="d-flex align-items-center mb-3">
                    <input type="number" name="amount" class="form-control me-2" min="1" placeholder="Qty" required style="max-width: 100px;">
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
