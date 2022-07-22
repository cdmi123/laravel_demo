<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class loginController extends Controller
{
    function login(Request $res)
    {
        if($res->login)
        {
            $email = $res->email;
            $pass = $res->pass;

            $user_data = DB::table('registeruser')->where('email',$email)->where('password',$pass);
            if($user_data->count()==1)
            {
                $user_value = $user_data->first();
                session(['user_id'=>$user_value->id]);
                return redirect('dashbord');
            }
        }
        return view('login');
    }

    function register()
    {
        return view('sign_up');
    }
}
