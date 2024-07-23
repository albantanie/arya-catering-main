@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
    <h3>Daftar Transaksi</h3>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Menu</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                                @if ($transaction->status === 'PENDING')
                                    <form action="{{ route('admin.transaction.approve', $transaction->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <button type="button" class="btn btn-success approve-btn" data-id="{{ $transaction->id }}">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.transaction.reject', $transaction->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <button type="button" class="btn btn-danger reject-btn" data-id="{{ $transaction->id }}">Reject</button>
                                    </form>
                                @else
                                    {{ $transaction->status }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
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
    </script>
@endsection
