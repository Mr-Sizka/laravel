@extends('layout')

@section('title', 'Tasks')
@section('content')

<div class="container">
    <div class="text-center">
        <h1>Daily Tasks</h1>
        <div class="row">
            <div class="col-md-12">
                <form method="get" id="taskForm">
                    @csrf
                    <input type="text" class="form-control" name="task" placeholder=" Enter your task ">
                    <br/>
                    <input type="button" onclick="save_task()" class="btn btn-primary" value="Save">
                    <input type="reset" class="btn btn-warning" value="Clear">
                </form>
                <br/>
                <br/>
                <table class="table table-dark" id="task-table" onload="load_tasks()">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Actions</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="task-table-body">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div>
        <a href="/logout" type="button" class="btn btn-danger">LogOut</a>
        <a type="button" onclick="profile_view()" class="btn btn-success">Profile</a>
    </div>
</div>



<script>

    function save_task() {
        var formData = $('#taskForm').serialize(); // Serialize form data

        var parsedFormData = {};
        formData.split('&').forEach(function (keyValue) {
            var pair = keyValue.split('=');
            parsedFormData[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
        });
        var task = parsedFormData['task'];
        $.ajax({
            type: 'POST',
            url: '/save_task',
            data: {
                'task': task
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                load_tasks();
                bootbox.alert({
                    message:'Data saved successfully',
                    title:'Success'
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function delete_task(data) {
        $.ajax({
            type: "GET",
            url: '/delete_task',
            data: {
                value: data
            },
            success: function (response) {
                alert(response)
                load_tasks()
            },
            error: function (response){
                alert(response)
            }
        });

    }

    function update_status(data) {
        $.ajax({
            type: "GET",
            url: '/update_status',
            data: {
                value: data
            },
            success: function (response) {
                alert(response)
                load_tasks()
            },
            error: function (response){
                alert(response)
            }
        });

    }

    function update_task(data){
        $.ajax({
            type: "GET",
            url: '/update_task',
            data: {
                value: data
            },
            success: function (response) {
                console.log(response)
                window.location.href = '/update_task_view/'+response
            },
            error: function (response){
                alert(response)
            }
        });

    }

    function load_tasks() {
        $.ajax({
            type: "GET",
            url: '/load_tasks',
            success: function (response) {
                document.getElementById('task-table-body').innerHTML = '';
                $.each(response, function (index, task) {
                    var status = task.status ? "completed" : "Mark As Completed";
                    var btn_status = '<button onClick="update_status(' + task.id + ')" type="button" className="btn btn-danger">' + status + '</button>'
                    $('#task-table-body').append(
                        '<tr>' +
                        '<th>' + task.id + '</th>' +
                        '<th>' + task.task + '</th>' +
                        '<th>' + '<button onClick="delete_task(' + task.id + ')" type="button" id="btnDanger" className="btn btn-danger"> Delete</button>' +
                        '<button onClick="update_task(' + task.id + ')" type="button" className="btn btn-danger"> update</button>' + '</th>' +
                        '<th>' + btn_status + '</th>' +
                        '</tr>'
                    );

                });

            },
            error: function (response){
                alert(response)
            }
        });
    }

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

@endsection('content')
