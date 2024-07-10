@extends('layout')

@section('title', 'Update')
@section('content')
<div class="container">
    <br/>
    <form action="/update" method="get" id="updateTaskForm">
        @csrf
        <input type="text" class="form-control" name="task" value="{{$task->task}}" required>
        <input type="hidden" class="form-control" name="id" value="{{$task->id}}">
        <br/>
        <button type="button" onclick="update_status_post()" class="btn btn-primary"> Update</button>
        <a href="/tasks" type="button" class="btn btn-warning"> cancel</a>
    </form>
</div>

<script>

    function update_status_post() {
        var formData = $('#updateTaskForm').serialize();

        var parsedFormData = {};
        formData.split('&').forEach(function (keyValue) {
            var pair = keyValue.split('=');
            parsedFormData[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
        });
        var task = parsedFormData['task'];
        var id = parsedFormData['id'];

        $.ajax({
            type: "POST",
            url: '/update_task_post',
            data: {
                task: task,
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response)
                window.location.href='/tasks'
                load_tasks()
            },
            error: function (response) {
                alert(response)
            }
        });

    }

</script>

@endsection('content')
