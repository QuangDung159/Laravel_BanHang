<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{

    const PATH_TO_ADMIN_PAGES_DIRECTORY = "pages.admin.";
    const URL_TO_ADMIN_PAGES= "/admin/";


    public function index()
    {
        return view(self::PATH_TO_ADMIN_PAGES_DIRECTORY . 'AdminLogin');
    }

    public function showDashboard()
    {
        return view(self::PATH_TO_ADMIN_PAGES_DIRECTORY . 'Dashboard');
    }

    public function doLoginAdmin(Request $req)
    {
        $adminEmail = $req->admin_email;
        $adminPassword = $req->admin_password;

        $result = DB::table('admin')
            ->where('email', '=', $adminEmail)
            ->where('password', '=', md5($adminPassword))->first();

        if ($result != NULL) {
            Session::put('admin_name', $result->name);
            Session::put('admin_id', $result->id);
            return Redirect::to(self::URL_TO_ADMIN_PAGES. 'dashboard');
        } else {
            Session::put('msg_login_fail', 'Login fail');
            return Redirect::to(self::URL_TO_ADMIN_PAGES . 'home');
        }
    }

    public function doLogoutAdmin()
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to(self::URL_TO_ADMIN_PAGES . 'home');
    }
}
