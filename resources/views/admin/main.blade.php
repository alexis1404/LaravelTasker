@extends('layouts.main')

@section('main_content')

    <div class="modal fade" id="adminTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminTaskModalLabel">User menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>User</h5>
                    <p>Click me and <a href="#" role="button" class="btn btn-secondary popover-test" id="viewUser" style="background-color: #2ab27b">EDIT</a> user</p>
                    <hr>
                    <h5>User`s tasks</h5>
                    <p>Click me and <a href="#" role="button" class="btn btn-secondary popover-test" id="editTask" style="background-color: #2a88bd">VIEW TASKS</a> this user.</p>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <button id="modalbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#adminTaskModal" data-whatever="@mdo" hidden="true">Open modal for @mdo</button>

    <h1 align="center" style="margin-top: 30px">Willkommen, Herr Admin! ;)</h1>
    <hr>

    <p align="center" id="backPanel">

    </p>

    <ul class="list-group" id="user_list">
    </ul>

    <div id="tasks_list" style="padding-bottom: 2%">

    </div>

    <script>

            $(document).ready(function () {

                let temp = null;

                userRequest();


                $("#user_list").on("click", ".list-group-item", function(event){
                    $('.list-group li').removeClass('active');
                    $(this).removeClass();
                    $(this).addClass("list-group-item active d-flex justify-content-between align-items-center");

                    temp = $(this).data('user');

                    $('#modalbutton').trigger('click');
                });


                $('#editTask').click(function () {
                    event.preventDefault();

                    $('#user_list').empty();

                    renderTasklist();

                });


                $( document ).on( "click", "#backButton", function() {
                    $('#backPanel').empty();
                    $('#tasks_list').empty();
                    userRequest();
                });

                $( document ).on( "click", ".buttonDeleteTask", function() {
                    event.preventDefault();
                    isDel = confirm('Are you sure?');
                    if(isDel){
                        $.ajax({
                            url: "admin/delete_task/" + $(this).data('taskdel'),
                            method: 'GET',
                            success: function (result) {

                            },

                        });
                    }
                });

                $( document ).on( "click", ".buttonEditTask", function() {
                    event.preventDefault();
                    $('#backPanel').empty();
                    $('#tasks_list').empty();

                    renderTaskEditor($(this).data('taskcontent'));

                });

                $( document ).on( "click", "#backButton1", function() {
                    $('#backPanel').empty();
                    $('#tasks_list').empty();
                    renderTasklist();
                });

                $( document ).on( "click", "#backButton2", function() {
                    $('#backPanel').empty();
                    $('#user_list').empty();
                    userRequest();
                });


                $( document ).on( "click", "#acceptEditData", function() {
                    event.preventDefault();
                    isEdit = confirm('Are you sure?');
                    if(isEdit) {
                        let form = $('#editTaskForm');
                        let formData = new FormData(form.get(0));

                        $.ajax({
                            url: '/admin/edit_task/' + $('#taskId').data('taskid'),
                            method: 'POST',
                            contentType: false,
                            processData: false,
                            data: formData,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (result) {
                                $('#backPanel').empty();
                                $('#tasks_list').empty();
                                renderTasklist();
                            }

                        });
                    }
                });

                $( document ).on( "click", "#acceptUserData", function() {
                    event.preventDefault();
                    isEdit = confirm('Are you sure?');
                    if(isEdit) {
                        let form = $('#editUserForm');
                        let formData = new FormData(form.get(0));

                        $.ajax({
                            url: 'admin/edit_user/' + $('#userId').data('userid'),
                            method: 'POST',
                            contentType: false,
                            processData: false,
                            data: formData,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (result) {
                                $('#backPanel').empty();
                                $('#user_list').empty();
                                userRequest();
                            }

                        });
                    }
                });

                $('#viewUser').click(function () {
                    event.preventDefault();
                    $('#user_list').empty();

                    renderUserForm();
                });

                ///============================================CUSTOM FUNCTIONS=================================///
                function getTaskStatusTemplate(status) {
                    temp2 = null;
                    if(status == 0){
                        temp2 =
                            '<p><b>STATUS</b>: Awaits moderation</p>' +
                            '<i class="fa fa-refresh fa-spin" style="font-size:34px; color: #b6a338"></i>';
                    }else if(status == 1){
                        temp2 =
                            '<p><b>STATUS</b>: In process</p>' +
                        '<i class="fa fa-cog fa-spin" style="font-size:34px; color: #2ab27b"></i>';
                    }else if (status == 2){
                        temp2 =
                            '<p><b>STATUS</b>: Decline</p>' +
                            '<i class="fa fa-wheelchair" style="font-size:48px;color:red"></i>';

                    }else if(status == 3){
                        temp2=
                            '<p><b>STATUS</b>: Successfully completed</p>' +
                            '<i class="fa fa-thumbs-o-up" style="font-size:48px;color:green"></i>';
                    }

                    return temp2;
                }

                function getSelectStatusList(status) {
                    temp1 = null;
                    if(status == 0){
                        temp1 =
                            '<select id="selectTaskStatus" class="form-control" id="controlSelect1" name="status">' +
                            '<option value="0" selected>Awaits moderation</option>' +
                            '<option value="1">In process</option>' +
                            '<option value="2">Decline</option>' +
                            '<option value="3">Successfully completed</option>' +
                            '</select>';
                    }else if(status == 1){
                        temp1 =
                            '<select id="selectTaskStatus" class="form-control" id="controlSelect1" name="status">' +
                            '<option value="0" >Awaits moderation</option>' +
                            '<option value="1" selected>In process</option>' +
                            '<option value="2">Decline</option>' +
                            '<option value="3">Successfully completed</option>' +
                            '</select>';
                    }else if(status == 2){
                        temp1 =
                        '<select id="selectTaskStatus" class="form-control" id="controlSelect1" name="status">' +
                        '<option value="0" >Awaits moderation</option>' +
                        '<option value="1">In process</option>' +
                        '<option value="2" selected>Decline</option>' +
                        '<option value="3">Successfully completed</option>' +
                        '</select>';
                    }else if (status == 3){
                        temp1 =
                            '<select id="selectTaskStatus" class="form-control" id="controlSelect1" name="status">' +
                            '<option value="0" >Awaits moderation</option>' +
                            '<option value="1">In process</option>' +
                            '<option value="2">Decline</option>' +
                            '<option value="3" selected>Successfully completed</option>' +
                            '</select>';
                    }

                    return temp1;
                }

                function renderTasklist() {
                    $.ajax({
                        url: "admin/get_user_task/" + temp,
                        success: function (result) {
                            if(result.length) {
                                for (var i in result) {
                                    $('#tasks_list').append(
                                        '<div class="jumbotron">' +
                                        '<h1 class="display-4">' + result[i]['name'] + '</h1>' +
                                        '<img src="' + 'storage/' + result[i]['image'] + '" style="width: 200px; height: 200px">' +
                                        '<hr>' +
                                        '<p class="lead">' + result[i]['description'] + '</p>' +
                                        '<hr class="my-4">' +
                                        '<p>' + result[i]['created_at'] + '</p>' +
                                        '<hr>' +
                                        '<p><b> ' + getTaskStatusTemplate(result[i]['status']) + '</p>' +
                                        '<hr>' +
                                        '<p class="lead">' +
                                        '<a class="btn btn-primary btn-lg buttonEditTask" href="#" role="button" style="width: 100px" data-taskcontent=" ' + result[i].id  +' ">Edit</a>' + '   ' +
                                        '<a class="btn btn-danger btn-lg buttonDeleteTask" href="#" role="button" style="width: 100px" data-taskdel="' + result[i].id +'">Delete</a>' +
                                        '</p>' +
                                        '</div>'
                                    );
                                }

                            }else {
                                $('#tasks_list').append(
                                    '<h3 align="center">Sorry, this user has not tasks!</h3>'
                                );
                            }

                            $('#backPanel').append(
                                '<button id="backButton" type="button" class="btn btn-primary btn-lg">BACK</button>'
                            );

                            setTimeout("$('#adminTaskModal').trigger('click');", 500);
                        },

                    });
                }

                function userRequest() {
                    $.ajax({
                        url: "/admin/get_users",
                        success: function (result) {
                            for (var i in result) {
                                $('#user_list').append(
                                    '<li class="list-group-item d-flex justify-content-between align-items-center" data-user="' + result[i].id + '">' + result[i]['first_name'] + '   <span class="badge badge-primary badge-pill">' +
                                    'Tasks  ' + result[i].tasks.length +'</span></li>'
                                );
                            }

                        },

                    });

                }

                function renderTaskEditor(id_task) {
                    $.ajax({
                        url: "admin/get_task/" + id_task,
                        success: function (result) {
                            event.preventDefault();
                            $('#tasks_list').append(
                            '<form id="editTaskForm" method="post" enctype="multipart/form-data">' +
                                '<div class="form-group">' +
                                '<label>Task name</label>' +
                            '<input type="text" class="form-control" id="taskNameField" name="name" value="' + result['name'] +'">' +
                                '</div>' +
                                '<div class="form-group">' +
                                '<label>Task description</label>' +
                            '<textarea id="taskDescriptionField" class="form-control" name="description">' + result['description'] +'</textarea>' +
                                '</div>' +
                                '<div class="form-group">' +
                                '<p>Current image</p>' +
                            '<img src="storage/' + result['image'] +'" style="width: 200px; height: 200px">' +
                                '<hr>' +
                                '<input id="taskImage" type="file" name="image" accept=".jpg, .jpeg, .png">' +
                                '</div>' +
                                    '<hr>' +
                                '<div class="form-check">' +
                                '<input type="checkbox" class="form-check-input" name="notify" id="notifCheckTask">' +
                                '<label class="form-check-label" for="notifCheckTask">Notify this user about the changes</label>' +
                                '<hr>' +
                                    '<input type="hidden" name="user_id" value="' + result['user_id'] +'">' +
                                '<div class="form-group">' +
                                '<label for="controlSelect1"><b>Status this task: </b></label>' +
                                getSelectStatusList(result['status']) +
                                '</div> <hr>' +
                                    '<p id="taskId" hidden data-taskid="' + result['id'] +'"></p>' +
                                '<button class="btn btn-primary" type="submit" id="acceptEditData">Accept</button>' +
                                '</form>'
                            );

                            $('#backPanel').append(
                                '<button id="backButton1" type="button" class="btn btn-primary btn-lg">BACK</button>'
                            );
                        },

                    });
                }

                function renderUserForm() {
                    $.ajax({
                        url: "admin/get_user/" + temp,
                        success: function (result) {
                            $('#user_list').append(
                                '<form id="editUserForm" method="post" enctype="multipart/form-data">' +
                                '<div class="form-group">' +
                                '<label>User name</label>' +
                                '<input type="text" class="form-control" id="userNameField" name="name" value="' + result['first_name'] +'">' +
                                '</div>' +
                                '<div class="form-group">' +
                                '<label>User email: </label>' +
                                '<input type="email" id="taskEmailField" class="form-control" name="email" value="' + result['email'] +'">' +
                                '</div>' +
                                '<div class="form-group">' +
                                '<p>New password</p>' +
                                '<input type="password" id="passField" class="form-control" name="password">' +
                                '</div>' +
                                '<hr>' +
                                    '<div class="form-check">' +
                                    '<input type="checkbox" class="form-check-input" name="notify" id="notifCheck">' +
                                    '<label class="form-check-label" for="notifCheck">Notify this user about the changes</label>' +
                                    '<hr>' +
                                '<button class="btn btn-primary" type="submit" id="acceptUserData">Accept</button>' +
                                '</form><p id="userId" hidden data-userid="' + result['id'] + '"></p><hr>'+
                                    '<button type="button" class="btn btn-danger btn-lg">DELETE THIS USER</button>'
                            );

                            $('#backPanel').append(
                                '<button id="backButton2" type="button" class="btn btn-primary btn-lg">BACK</button>'
                            );

                            setTimeout("$('#adminTaskModal').trigger('click');", 500);
                        },

                    });
                }

            });
    </script>
@endsection