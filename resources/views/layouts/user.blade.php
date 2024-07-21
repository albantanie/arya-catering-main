@extends('layouts.main')

@section('body')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}">Dapoer Lina</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if (auth()->user())
                    <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fs-4" aria-current="page" href="{{ route('cart.index') }}"><i
                                    class="bi bi-cart"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4" href="{{ route('transaction.index') }}"><i
                                    class="bi bi-receipt"></i></a>
                        </li>
                    </ul>
                    <span class="me-2 fw-medium">Welcome, {{ auth()->user()->name }}</span>
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('logout') }}">Logout</a>
                @else
                    <a class="btn btn-outline-success ms-auto" href="{{ route('login') }}">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="p-3">
        @yield('content')
    </div>
@endsection
