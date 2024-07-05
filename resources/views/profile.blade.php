@extends('layout')
@section('title','Profile')

@section('content')

<!--<div class="container ">
    <div class="text-center">
        <div class="row">
            <div class="col-md-12">
                <h1>Profile</h1>
                <div class="container ">
                    <div class="row ">
                        <div class="col-md-6 border border-primary ">
                            <div class="mb-5">
                                <label for="name">First Name</label>
                                <input type="text" readonly value="Sisuka">
                            </div>
                            <div class="mb-5">
                                <label for="name">First Name</label>
                                <input type="text" readonly value="Sisuka">
                            </div>
                            <div class="mb-5">
                                <label for="name">First Name</label>
                                <input type="text" readonly value="Sisuka">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>-->
<!--</div>-->

<div class="container p-5 min-vh-100 d-flex align-items-center justify-content-center" >
<!--    <div class="row justify-content-center">-->
        <div class="col-md-6">
            <div class="card shadow-lg rounded-5 " style="background:lavender">
                <div class="card-header text-center"><h1><strong>Profile</strong></h1></div>
                <div class="card-body">
                    @foreach($data as $user)
                    <div class="text-center mb-4">
                        <img src="{{URL::asset('uploads/images/'.$user->image)}}" class="rounded-circle shadow " style="width: 150px; height: 150px;"  alt="Profile Image">
                    <h3 class="text-wrap text-capitalize">{{$user->first_name}}&nbsp{{$user->last_name}}</h3>
                    <p class="text-wrap text-lowercase">{{$user->email}}</p>
                        @endforeach
                    </div>
                    <a type="button" href="/tasks" class="btn btn-primary">Back</a>
                </div>
            </div>
<!--        </div>-->
    </div>
</div>

@endsection('content')
