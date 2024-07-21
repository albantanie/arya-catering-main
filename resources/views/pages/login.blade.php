@extends('layouts.main')

@section('head')
<style>
    body {
        background-image: url('https://ichef.bbci.co.uk/ace/ws/800/cpsprodpb/10D74/production/_126208986_wed5.jpg.webp');
    }
</style>
@endsection

@section('body')
<div class="row justify-content-center align-items-center" style="height: 80vh">
    <form class="col-md-3 text-center" method="POST">
        @csrf
        <h4 class="mb-3">Login</h4>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="{{ route('register') }}">Register</a>
    </form>
</div>
@endsection
