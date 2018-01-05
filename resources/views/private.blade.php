@extends('layouts.main')

@section('main_content')

    <h1 align="center" style="margin-top: 30px">Welcome in your private room!</h1>
    <p align="center"><button type="button" class="btn btn-primary btn-lg">Create new task?</button></p>
    <hr>

        @if($all_tasks->isEmpty())
            <div class="alert alert-warning" role="alert">
            <h3 align="center">No tasks. Create now!</h3>
            </div>
        @endif

@endsection