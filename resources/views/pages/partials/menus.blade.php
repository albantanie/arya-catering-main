@foreach ($menus as $menu)
    <div class="col">
        <div class="card h-100 border-0 shadow-sm">
            <img src="/storage/{{ $menu->image }}" class="card-img-top" alt="{{ $menu->name }}" style="object-fit: cover; height: 200px;">
            <div class="card-body d-flex flex-column">
                <h6 class="card-title text-truncate">{{ $menu->name }}</h6>
                <p class="card-text text-primary fw-bold mt-auto mb-2">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
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
