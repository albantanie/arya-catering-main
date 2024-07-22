

    <!-- Menu Items -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($menus as $menu)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="/storage/{{ $menu->image }}" class="card-img-top" alt="{{ $menu->name }}" style="object-fit: cover; height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title text-truncate">{{ $menu->name }}</h6>
                        <p class="card-text text-primary fw-bold mt-auto mb-2">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                        <div class="d-flex">
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                            <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

