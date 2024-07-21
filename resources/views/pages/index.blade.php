@extends('layouts.user')

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-4"><img src="/photos/1.jpeg" alt="#" width="400" height="300"></div>
    <div class="col-4"><img src="/photos/2.jpeg" alt="#" width="400" height="300"></div>
    <div class="col-4"><img src="/photos/3.jpeg" alt="#" width="400" height="300"></div>
</div>

<div class="mt-5">
    <marquee class="bg-secondary text-light">
        <div class="row text-center">
            <h3 class="col-3">DAPOER LINA</h3>
            <h3 class="col-3">DAPOER LINA</h3>
            <h3 class="col-3">DAPOER LINA</h3>
            <h3 class="col-3">DAPOER LINA</h3>
        </div>
    </marquee>
</div>

<div class="mt-5">
    <div class="row text-center">
        <div class="col-4">
            <h1>DAPOER LINA</h1>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <h1 class="d-inline me-3"><i class="bi bi-instagram"></i></h1>
            <h1 class="d-inline"><i class="bi bi-whatsapp"></i></h1>
            </div>
            <a href="#" class="btn btn-outline-dark">
                <i class="bi bi-geo-alt-fill"></i>
                Find us here
            </a>
        </div>
        <div class="col-4">
            <h4>Telp. +6287743144329</h4>
        </div>
    </div>
</div>
@endsection
