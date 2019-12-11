<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    const PATH_TO_ADMIN_PAGES_DIRECTORY = "pages.admin.";


    public function index()
    {
        return view(self::PATH_TO_ADMIN_PAGES_DIRECTORY . 'AdminLogin');
    }

    public function showDashboard()
    {
        return view(self::PATH_TO_ADMIN_PAGES_DIRECTORY . 'Dashboard');
    }
}
