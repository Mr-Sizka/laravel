@extends('layout')

@section('title', 'Register')
@section('content')
<div class="container ">
    <div class="text-center">
        <div class="row">
            <div class="col-md-12">
                <h1>Register</h1>
                <form action="/register" method="post" class="form-control">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" required placeholder="User Name">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" required placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" required placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button type="reset" class="btn btn-warning"> clear</button>
                    <div><a href="/login">Login</a></div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')

