@extends('layout')

@section('title', 'Register')
@section('content')


<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row rounded-5 bg-white border flex-column shadow p-3">
        <div class="box">
            <h1 class="text-center">Register</h1>
            @foreach($errors as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
            @endforeach
            <form action="/register" method="post" class="form-control border-0 p-2 d-flex flex-column align-items-left justify-content-center" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" name="first_name" class="form-control-lg bg-light fs-6 " required placeholder="First Name">
                </div>
                <div class="mb-3">
                    <input type="text" name="last_name" class="form-control-lg bg-light fs-6" required placeholder="Last Name">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control-lg bg-light fs-6" required placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control-lg bg-light fs-6" required placeholder="Password">
                </div>
                <div class="mb-3 ">
                    <input type="file" name="image" required placeholder="Add Picture">
                </div>
                <button type="submit" class="btn btn-primary mb-3">Register</button>
                <button type="reset" class="btn btn-warning mb-3"> Clear</button>
                <div class="text-center"><a href="/login">Login</a></div>
            </form>
        </div>
    </div>
</div>
@endsection('content')

