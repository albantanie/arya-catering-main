@extends('layouts.main')

@section('body')
<div class="row justify-content-center align-items-center" style="height: 80vh">
    <form class="col-md-4 text-center" method="POST" action="{{ route('register.store') }}">
        @csrf
        <h4 class="text-center">Register</h4>
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="name" name="name" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">REGISTER</button>
        <a href="{{ route('login') }}">Login</a>
    </form>
</div>
@endsection
