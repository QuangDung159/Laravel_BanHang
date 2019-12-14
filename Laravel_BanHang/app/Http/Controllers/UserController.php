<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    const PATH_CLIENT = 'pages.client.';
    const URL_LOGIN = '/login';

    public function showLoginPage()
    {
        return view(self::PATH_CLIENT . 'Login')
            ->with('isShowSlider', false)
            ->with('isShowSideBar', false);
    }
}
