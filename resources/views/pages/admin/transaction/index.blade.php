@extends('layouts.admin')

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
                    <th>No</th> <!-- Updated to reflect sequential number -->
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
                                    <form action="{{ route('admin.transaction.approve', $transaction->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.transaction.reject', $transaction->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
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
