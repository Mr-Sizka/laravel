@extends('layout')

@section('title', 'LogIn')
@section('content')
<!--<div class="container ">
    <div class="text-center">
        <div class="row justify-content-center">
            <div class="col-md-3">
            <h1>Login</h1>
                @foreach($errors as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
                @endforeach
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
</div>-->

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row rounded-5 bg-white border flex-column shadow p-3">
        <div class="box">
            <h1 class="text-center">LogIn</h1>
            @foreach($errors as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
            @endforeach
            <form action="/login" method="post" class="form-control border-0 p-2 d-flex flex-column align-items-left justify-content-center">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control-lg bg-light fs-6 " required placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control-lg bg-light fs-6 " required placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary mb-3">LogIn</button>
                <button type="reset" class="btn btn-warning mb-3"> Clear</button>
                <div class="text-center">
                    <a href="/register" >Register</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content')
