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
                            <input type="text" class="form-control" id="task-name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="desc-text" class="col-form-label">Description task:</label>
                            <textarea class="form-control" id="desc-text" name="description"></textarea>
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