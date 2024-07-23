@extends('layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional: Custom styles for modal */
        .modal-body {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <h3>Daftar Transaksi</h3>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Menu</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 1; @endphp <!-- Initialize counter -->
                    @foreach ($transactions as $transaction)
                        @foreach (json_decode($transaction->menu) as $item)
                            <tr>
                                <td>{{ $counter++ }}</td> <!-- Display sequential number -->
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $item->menu->name }}</td>
                                <td>Rp{{ number_format($item->menu->price * $item->amount, 2, ',', '.') }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>
                                    @if ($transaction->payment_proof)
                                        <img src="{{ asset('storage/' . $transaction->payment_proof) }}" alt="Bukti Pembayaran" width="100" class="img-thumbnail payment-proof" data-toggle="modal" data-target="#imageModal" data-src="{{ asset('storage/' . $transaction->payment_proof) }}">
                                    @else
                                        <span class="text-muted">Belum ada bukti pembayaran</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for image preview -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // SweetAlert2 confirmation dialogs for approve and reject buttons
        document.querySelectorAll('.approve-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Apakah Anda benar-benar ingin menyetujui transaksi ini?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, setujui!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.reject-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Apakah Anda benar-benar ingin menolak transaksi nomor ini?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tolak!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Image modal handling
        document.querySelectorAll('.payment-proof').forEach(image => {
            image.addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = src;
            });
        });
    </script>
@endsection
