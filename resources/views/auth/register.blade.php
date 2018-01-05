@extends('layouts.main')

@section('main_content')

    <h1 align="center" style="margin-top: 30px">Please, register now</h1>
    <hr>

    <form action="{{route('registerForm')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" name="inputName" aria-describedby="emailHelp" placeholder="Enter name">
            <small id="emailHelp" class="form-text text-muted">Input your name:</small>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    @endsection