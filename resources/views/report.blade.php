@extends('layout')
@section('title',"Report")
@section('content')
<div class="container p-5">
        <div class="row d-flex align-items-center justify-content-center">
            <h1 class="text-center">Task Report</h1>
        </div>
        <div class="d-flex flex-row-reverse" >
            <a onclick="profile_view()" type="button" class="btn btn-warning align-self-end ">Back to Profile</a>
        </div>


    <table id="myTable">
        <thead>
        <tr>
            <th>Created User</th>
            <th>Task</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{$task->first_name}}&nbsp{{$task->last_name}}</td>
            <td>{{$task->task}}</td>
            <td>
                @if($task->status)
            Completed
                @else
            Not Completed
            @endif</td>
            <td>{{$task->created_at}}</td>
            <td>{{$task->updated_at}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection('content')

@section('table')

<script>
    let table = new DataTable('#myTable',{
        layout: {
            topStart: {
                buttons: ['copy', 'csv','excel','pdf', 'print']
            }
        }
    });

    function profile_view(){
        $.ajax({
            type: "GET",
            url: '/profile',
            success: function (response) {
                window.location.href = '/profile_view/'+response
            },
            error: function (response){
                alert(response)
            }
        });
    }
</script>

@endsection('table')
