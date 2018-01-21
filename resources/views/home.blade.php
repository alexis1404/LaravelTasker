@extends('layouts.main')

@section('main_content')

    <div id="info-area">

        <hr>
        <h1 align="center" style="text-shadow: 5px 1px 6px #636b6f;">Welcome! Are you ready?</h1>
        <hr>

        <div class="alert alert-light" role="alert">
            <h5 align="center" style="font-size: 40px " >Create task</h5>
        </div>

        <div class="alert alert-light" role="alert">
            <h5 align="center" style="font-size: 40px;">Admin moderates the task and monitors its implementation</h5>
        </div>

        <div class="alert alert-light" role="alert">
            <h5 align="center" style="font-size: 40px">Keep track of the status! ;)</h5>
        </div>

        <hr>

        <p align="center"><a href="{{url('/private_room')}}" class="button1">GO!</a></p>

    </div>

@endsection