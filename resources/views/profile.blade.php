@extends('layout')
@section('title','Profile')

@section('content')

<div class="container p-5 min-vh-100 d-flex align-items-center justify-content-center" >
        <div class="col-md-6">
            <div class="card shadow-lg rounded-5 " style="background:lavender">
                <div class="card-header text-center"><h1><strong>Profile</strong></h1></div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{URL::asset('uploads/images/'.$user->image)}}" class="rounded-circle shadow " style="width: 150px; height: 150px;"  alt="Profile Image">
                    <h3 class="text-wrap text-capitalize">{{$user->first_name}}&nbsp{{$user->last_name}}</h3>
                    <p class="text-wrap text-lowercase">{{$user->email}}</p>
                    </div>
                    <a type="button" href="/tasks" class="btn btn-primary">Back</a>
                    <a type="button" href="/report" class="btn btn-success">Generate Report</a>
                </div>
            </div>
    </div>
</div>

@endsection('content')
