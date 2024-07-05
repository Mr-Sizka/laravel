@extends('layout')

@section('title', 'Tasks')
@section('content')

<div class="container">
    <div class="text-center">
        <h1>Daily Tasks</h1>
        <div class="row">
            <div class="col-md-12">
                @foreach($errors->all() as $error)

                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
                @endforeach
                <form method="post" action="/save">
                    @csrf
                    <input type="text" class="form-control" name="task" placeholder=" Enter your task ">
                    <input type="hidden" class="form-control" name="user_id" hidden value="{{$user->id}}">
                    <br/>
                    <input type="submit" class="btn btn-primary" value="Save">
                    <input type="reset" class="btn btn-warning" value="Clear" >
                </form>
                <br/>
                <br/>
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Actions</th>
                        <th>Status</th>
                    </tr>
                    @foreach($tasks as $task)
                    <tr>
                        <th>{{$task->id}}</th>
                        <th>{{$task->task}}</th>
                        <th>
                            <a class="btn btn-danger" href="/delete/{{$task->id}}" >Delete</a>
                            <a class="btn btn-warning" href="/update/{{$task->id}}"  >Update</a>
                        </th>
                        <th>@if($task->status)
                            <a class="btn btn-success" href="/mark/{{$task->id}}"  >completed</a>
                            @else
                                <a class="btn btn-primary"  href="/mark/{{$task->id}}" >Mark as complete</a>
                            @endif
                        </th>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
    <div>
        <a href="/logout" type="button" class="btn btn-danger">LogOut</a>
        <a href="/profile" type="button" class="btn btn-success">Profile</a>
    </div>
</div>

@endsection('content')
