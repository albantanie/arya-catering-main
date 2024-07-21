@extends('layouts.user')

@section('content')
    <h3>Daftar Transaksi</h3>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    @foreach (json_decode($transaction->menu) as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->menu->name }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>Rp{{ number_format($item->menu->price * $item->amount, 2, ',', '.') }}</td>
                            {{-- <td>Rp{{ number_format($transaction->total_price, 2, ',', '.') }}</td> --}}
                            <td>{{ $transaction->status }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
