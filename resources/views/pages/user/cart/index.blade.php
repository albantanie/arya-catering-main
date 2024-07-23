@extends('layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
    <h3>Keranjang</h3>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="row">
        <div class="col-8">
            @foreach ($carts as $cart)
                <div class="row w-100 mb-3 align-items-center">
                    <div class="col-1">
                        <img src="/storage/{{ $cart->menu->image }}" alt="{{ $cart->menu->name }}" width="50" height="50"
                            class="border border-black rounded">
                    </div>
                    <div class="col-7">
                        <h5>{{ $cart->menu->name }}</h5>
                        <p class="text-secondary">
                            {{ $cart->amount }} x
                            Rp{{ number_format($cart->menu->price, 2, ',', '.') }}
                        </p>
                    </div>
                    <div class="col-3">
                        <h6>Rp{{ number_format($cart->menu->price * $cart->amount, 2, ',', '.') }}</h6>
                    </div>
                    <div class="col-1">
                        <a href="#" class="text-danger remove-item" data-url="{{ route('user.cart.delete', $cart->id) }}">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
            <hr>
            @php
                $total = 0;
                foreach ($carts as $cart) {
                    $total += $cart->menu->price * $cart->amount;
                }
            @endphp
            <div class="row w-100">
                <div class="col-9">
                    <h5>Total</h5>
                </div>
                <div class="col-3">
                    <h6>Rp{{ number_format($total, 2, ',', '.') }}</h6>
                </div>
            </div>
            <div class="mt-5">
                <h3>Pilih Pengiriman</h3>
                <div class="form-group">
                    <input type="radio" name="delivery" id="online" value="Online Delivery" class="btn-check">
                    <label class="btn btn-outline-dark w-100 text-start" for="online">Online Delivery</label>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="border rounded p-4">
                <div class="row">
                    <div class="col">
                        <h5>Total Keranjang</h5>
                    </div>
                    <div class="col">
                        <p>Rp{{ number_format($total, 2, ',', '.') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Biaya Pengiriman</h5>
                    </div>
                    <div class="col">
                        <p>Rp{{ number_format($total, 2, ',', '.') }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h5>Total Bayar</h5>
                    </div>
                    <div class="col">
                        <p>Rp{{ number_format($total, 2, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <h5>Informasi Kontak</h5>
                    <p class="text-body-secondary">
                        Arya Deva Permana <br>
                        0812 3456 7890
                    </p>
                </div>
                <div class="mt-4">
                    <h5>Alamat</h5>
                    <p class="text-body-secondary">
                        Jl. Rawa Badak Selatan No.90 <br>
                        Gading Serpong, Tangerang Selatan <br>
                        Prov. Banten 15415
                    </p>
                </div>
                <div class="mt-4">
                    <h5>Pilih Metode Pembayaran</h5>
                    <div class="form-group">
                        <input type="radio" name="payment" id="qris" value="QRIS" class="btn-check">
                        <label class="btn btn-outline-dark w-100 text-start" for="qris">QRIS</label>
                    </div>
                    <div class="form-group mt-2">
                        <input type="radio" name="payment" id="transfer" value="Transfer Bank" class="btn-check">
                        <label class="btn btn-outline-dark w-100 text-start" for="transfer">Transfer Bank</label>
                    </div>
                </div>
                <form id="checkout-form" action="{{ route('user.transaction.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="total_price" id="total_price" value="{{ $total }}">
                    <input type="hidden" name="menu" id="menu" value="{{ json_encode($carts) }}">
                    <button type="submit" class="btn btn-secondary w-100">Lanjut ke pembayaran</button>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Handle item removal confirmation
        document.querySelectorAll('.remove-item').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('data-url');
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin ingin menghapus item ini dari keranjang?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Berhasil', 'Item berhasil dihapus dari keranjang', 'success')
                            .then(() => {
                                window.location.href = url;
                            });
                    }
                });
            });
        });

        // Handle checkout confirmation
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin akan melanjutkan ke pembayaran?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil', 'Anda akan dialihkan ke halaman pembayaran', 'success')
                        .then(() => {
                    this.submit();
                });
                }
            });
        });
    });
</script>

@endsection
