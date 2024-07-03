@extends('layout')

@section('title', 'Update')
@section('content')
<div class="container">
    <br/>
    <form action="/update" method="get">
        @csrf
        <input type="text" class="form-control" name="task" value="{{$task->task}}" required>
        <input type="hidden" class="form-control" name="id" value="{{$task->id}}">
        <br/>
        <button  type="submit" class="btn btn-primary"> Update</button>
        <a href="/tasks" type="button" class="btn btn-warning" > cancel</a>
    </form>
</div>

@endsection('content')
