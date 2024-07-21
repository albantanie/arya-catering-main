@extends('layouts.user')

@section('content')
    <div class="row p-3">
        @foreach ($menus as $menu)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="/storage/{{$menu->image }}" class="card-img-top" alt="..." style="aspect-ratio: 2/1">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                        <form action="{{ route('cart.add') }}" method="POST"">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="menu_id" id="menu_id" value="{{ $menu->id }}">
                            <input type="number" name="amount" id="amount" required>
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
