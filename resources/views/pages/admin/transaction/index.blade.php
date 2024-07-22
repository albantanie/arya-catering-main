@extends('layouts.admin')

@section('content')
    <h3>Daftar Transaksi</h3>
    
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
                @php $counter = 1; @endphp
                @foreach ($transactions as $transaction)
                    @foreach (json_decode($transaction->menu) as $item)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $item->menu->name }}</td>
                            <td>Rp{{ number_format($item->menu->price * $item->amount, 2, ',', '.') }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>
                                @if ($transaction->status === 'PENDING')
                                    <form id="approve-form-{{ $transaction->id }}" action="{{ route('admin.transaction.approve', $transaction->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="button" class="btn btn-success" onclick="confirmAction(event, 'approve', {{ $transaction->id }})">Approve</button>
                                    </form>
                                    <form id="reject-form-{{ $transaction->id }}" action="{{ route('admin.transaction.reject', $transaction->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="button" class="btn btn-danger" onclick="confirmAction(event, 'reject', {{ $transaction->id }})">Reject</button>
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
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmAction(event, action, transactionId) {
            event.preventDefault();
            let formId = action === 'approve' ? `approve-form-${transactionId}` : `reject-form-${transactionId}`;
            let confirmButtonText = action === 'approve' ? 'Yes, approve it!' : 'Yes, reject it!';
            let confirmTitle = action === 'approve' ? 'Approve Confirmation' : 'Reject Confirmation';
            let confirmText = action === 'approve' ? 'Are you sure you want to approve this transaction?' : 'Are you sure you want to reject this transaction?';

            Swal.fire({
                title: confirmTitle,
                text: confirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection
