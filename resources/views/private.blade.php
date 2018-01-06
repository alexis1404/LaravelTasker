@extends('layouts.main')

@section('main_content')

    <h1 align="center" style="margin-top: 30px">Welcome in your private room!</h1>
    <p align="center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskCreateModal">Create new task</button>
    </p>
    <hr>

        @if($all_tasks->isEmpty())
            <div class="alert alert-warning" role="alert">
            <h3 align="center">No tasks. Create now!</h3>
            </div>
        @else
            @foreach($all_tasks as $task)

                <div class="jumbotron">
                    <h1 class="display-4">{{$task->name}}</h1>
                    <img src="{{asset('storage/' . $task->image)}}" style="width: 200px; height: 200px">
                    <hr>
                    <p class="lead">{{$task->description}}</p>
                    <hr class="my-4">
                    <p>{{$task->created_at}}</p>
                    <hr>
                    @if($task->status == 0)
                        <p><b>STATUS</b>: Awaits moderation</p>
                    <i class="fa fa-refresh fa-spin" style="font-size:34px; color: #b6a338"></i>
                    @elseif($task->status == 1)
                        <p><b>STATUS</b>: In process</p>
                        <i class="fa fa-cog fa-spin" style="font-size:34px; color: #2ab27b"></i>
                    @elseif($task->status == 2)
                        <p><b>STATUS</b>: Decline</p>
                        <i class="fa fa-wheelchair" style="font-size:48px;color:red"></i>
                    @elseif($task->status == 3)
                        <p><b>STATUS</b>: Successfully completed</p>
                        <i class="fa fa-thumbs-o-up" style="font-size:48px;color:green"></i>
                    @endif
                    <hr>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="{{url('edit_page/' . $task->id)}}" role="button" style="width: 100px">Edit</a>
                        <a class="btn btn-danger btn-lg" href="{{url('/delete_task/' . $task->id)}}" role="button" style="width: 100px">Delete</a>
                    </p>
                </div>


                @endforeach

        @endif


    <div class="modal fade" id="taskCreateModal" tabindex="-1" role="dialog" aria-labelledby="taskCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskCreateModalLabel">New task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('createTask')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="task-name" class="col-form-label">Name task:</label>
                            <input type="text" class="form-control" id="task-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="desc-text" class="col-form-label">Description task:</label>
                            <textarea class="form-control" id="desc-text" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="loadPicture">Your picture for task</label>
                            <hr>
                            <input type="file" name="image" accept=".jpg, .jpeg, .png">
                        </div>
                        <button type="submit" class="btn btn-primary">Create task!</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

@endsection