<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Tasker</title>

    <!--Include any resources-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Roboto" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>

        body{
            background: url("{{asset('images/pattern2.jpg')}}");
            background-size: 100%;
        }

        #header{
            margin-top: 10px;
            font-family: 'Courgette', cursive;
        }

        a.button1 {
            position: relative;
            color: white;
            font-weight: bold;
            text-decoration: none;
            text-shadow: -1px -1px #1d1d1c;
            user-select: none;
            padding: .8em 2em;
            outline: none;
            background-color: #1d1d1c;
            background-image: linear-gradient(45deg, rgba(255,255,255,.0) 30%, rgba(255,255,255,.8), rgba(66, 66, 65, 0) 70%), radial-gradient(190% 100% at 50% 0%, rgba(255,255,255,.7) 0%, rgba(255,255,255,.5) 50%, rgba(0,0,0,0) 50%);
            background-repeat: no-repeat;
            background-size: 200% 100%, auto;
            background-position: 200% 0, 0 0;
            box-shadow: rgba(29, 29, 28, 0.3) 0 2px 5px;
        }
        a.button1:active {
            top: 1px;
            box-shadow: none;
        }
        a.button1:hover {
            transition: .5s linear;
            background-position: -200% 0, 0 0;
        }


        #info-area{

            font-family: 'Courgette', cursive;
        }


    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <!-- Navbar content -->
    <a class="navbar-brand" href="{{url('/')}}">Tasker</a>
    @if(!Sentinel::check())
    <a class="navbar-brand" href="{{route('authPage')}}">Login</a>
        <a class="navbar-brand" href="{{route('registerPage')}}">Register</a>
    @endif
    @if(Sentinel::check())
    <a class="navbar-brand" href="{{route('logout')}}">Logout</a>
        <a class="navbar-brand" href="{{route('privatePage')}}">Private room</a>
    @endif
    @if(Sentinel::check() && Sentinel::inRole('admin'))
        <a class="navbar-brand" href="{{route('adminPage')}}">Admin Room</a>
    @endif
    <a class="navbar-brand" href="{{route('accPage')}}" title="Go to account room">Welcome
        @if($user = Sentinel::check())
            {{$user->first_name}}
        @endif
        !</a>
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col">

        </div>
        <div class="col-9">
            <div id="header">
                <h1 align="center" style="font-size: 100px; text-shadow: 5px 1px 6px #636b6f;">TASKER</h1>
            </div>
        </div>
        <div class="col">

        </div>
    </div>

    <div class="row">
        <div class="col">

        </div>
        <div class="col-9">
            <div class="content">
                @yield('main_content')
            </div>
        </div>
        <div class="col">

        </div>
    </div>


</div>

<script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>
</body>
</html>
