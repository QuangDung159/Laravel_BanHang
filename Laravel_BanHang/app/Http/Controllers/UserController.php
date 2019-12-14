<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class UserController extends Controller
{
    const PATH_CLIENT = 'pages.client.';
    const URL_LOGIN = '/login';
    const TABLE_NAME = 'user';

    public function showLoginPage()
    {
        return view(self::PATH_CLIENT . 'Login')
            ->with('isShowSlider', false)
            ->with('isShowSideBar', false);
    }

    public function doSignUp(Request $req)
    {
        $email = $req->email;
        $fullName = $req->full_name;
        $password = $req->password;

        // validation

        $data = [];
        $data['name'] = $fullName;
        $data['password'] = md5($password);
        $data['email'] = $email;
        $data['created_at'] = time();

        DB::table(self::TABLE_NAME)
            ->insert($data);
        Session::put('msg_sign_up_success', 'Sign up successfully! Please login to continue');
        return view(self::PATH_CLIENT . 'Login')
            ->with('isShowSlider', false)
            ->with('isShowSideBar', false);
    }
}
