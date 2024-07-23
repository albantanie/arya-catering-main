@extends('layouts.main')

@section('body')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('admin.index')}}">Dapoer Lina</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('admin.menu.index') }}">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.transaction.index') }}">Transaksi</a>
                    </li>
                </ul>
                <h6 class="me-2">Welcome, {{ auth()->user()->name }}</h6>
                <a class="btn btn-outline-dark" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="p-3">
        @yield('content')
    </div>
@endsection
