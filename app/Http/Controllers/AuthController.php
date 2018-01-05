<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentinel;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }

    public function registerForm(Request $request)
    {
        $credentials = [
            'email'    => $request->inputEmail,
            'password' => $request->inputPassword,
            'first_name' => $request->inputName
        ];

        if($credentials){

            $new_user = Sentinel::registerAndActivate($credentials);

            $role = Sentinel::findRoleByName('user');

            $role->users()->attach($new_user);

            return redirect('/');
        }
    }

    public function authPage()
    {
        return view('auth.authorization');
    }

    public function authForm(Request $request)
    {
        $credentials = [
            'email'    => $request->inputEmail,
            'password' => $request->inputPassword,
        ];

        if(Sentinel::authenticate($credentials)){

            return redirect('/');

        }else{

            $message = 'Sorry, authentication is invalid! Input your data once again, or register now';

            return view('auth.authorization', compact('message'));
        }
    }

    public function logout()
    {
        Sentinel::logout();

        return redirect('/');
    }
}
