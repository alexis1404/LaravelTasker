@extends('layouts.main')

@section('main_content')

    <h1 align="center" style="margin-top: 30px">Welcome, {{$user->first_name}} !</h1>
    <br>
    <h3 id="successEditMessage" align="center" style="color: #2ab27b">Your user data successfully edited!</h3>

    <form id="userAccountDataEdit">
        <div class="form-group" id="EditUserData">
            <label>Your name: </label>
            <input type="text" class="form-control" name="name" value="{{$user->first_name}}">
        </div>
        <div class="form-group">
            <label>Your email:</label>
            <input type="email" class="form-control" name="email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <p>Your new password:</p>
           <input type="password" name="password" id="passField">
        </div>
        <div class="form-group">
            <p>Confirm password: </p>
            <input type="password" id="passFieldConfirm">
        </div>
        <p hidden data-userid="{{$user->id}}" id="userId"></p>
        <p style="color: red" id="errorPassMessage">Confirm your password!</p>
        <button type="submit" class="btn btn-primary" id="submitUserAccountEdit">Submit</button>
    </form>

    <script>

        $(document).ready(function () {

            $('#errorPassMessage').hide();
            $('#successEditMessage').hide();

            $('#submitUserAccountEdit').click(function () {
                event.preventDefault();
                isConfirm = confirm('Are you sure?');
                if(isConfirm){
                    let form = $('#userAccountDataEdit');
                    let formData = new FormData(form.get(0));
                    let pass = $('#passField').val();
                    let confirm_pass = $('#passFieldConfirm').val();
                    if(pass === confirm_pass){
                        $.ajax({
                            url: '/edit_user/' + $('#userId').data('userid'),
                            method: 'POST',
                            contentType: false,
                            processData: false,
                            data: formData,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (result) {
                                $('#errorPassMessage').hide();
                                $("#successEditMessage").fadeIn(700);
                                setTimeout('$("#successEditMessage").fadeOut(3000);', 5000)

                            }

                        });
                    }else {
                        $('#errorPassMessage').show();
                    }

                }
            });

        });

    </script>
@endsection