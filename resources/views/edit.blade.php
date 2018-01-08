@extends('layouts.main')

@section('main_content')

    <h1 align="center" style="margin-top: 30px">Edit your task</h1>
    <hr>

    <form action="{{url('edit_task/' . $task->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label>Task name</label>
            <input type="text" class="form-control" name="name" value="{{$task->name}}">
        </div>
        <div class="form-group">
            <label>Task description</label>
            <textarea class="form-control" name="description">{{$task->description}}</textarea>
        </div>
        <div class="form-group">
            <p>Current image</p>
            <img src="{{asset('storage/' . $task->image)}}" style="width: 200px; height: 200px">
            <hr>
            <input type="file" name="image" accept=".jpg, .jpeg, .png">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection