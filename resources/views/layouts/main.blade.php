<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tasker</title>

    <!--Include any resources-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Roboto" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>

        body{
            background-color: #fff;
        }

        #header{
            margin-top: 10px;
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


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col">

        </div>
        <div class="col-9">
            <div id="header">
                <h1 align="center" style="font-size: 100px">TASKER</h1>
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

</body>
</html>