@extends('layouts.main')

@section('main_content')

    <h1 align="center" style="margin-top: 30px">Edit your task</h1>
    <hr>

    <form action="{{url('edit_task/' . $task->id)}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Task name</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Task description</label>
            <input type="password" class="form-control"  placeholder="">
        </div>
        <div class="form-group">
            <label for="loadPicture">Your picture for task</label>
            <hr>
            <input type="file" name="image" accept=".jpg, .jpeg, .png">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection