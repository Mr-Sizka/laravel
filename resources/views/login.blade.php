@extends('layout')

@section('title', 'LogIn')
@section('content')
<div class="container ">
    <div class="text-center">
        <div class="row">
            <div class="col-md-12">
            <h1>Login</h1>
            <form action="/login" method="post" class="form-control">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" required placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" required placeholder="password">
                </div>
                <button type="submit" class="btn btn-primary">LogIn</button>
                <button type="reset" class="btn btn-warning"> clear</button>
                <div >
                    <a href="/register" >Register</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')
