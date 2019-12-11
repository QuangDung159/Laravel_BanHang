<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.AdminLogin');
    }

    public function showDashboard()
    {
        return view('layouts.AdminLayout');
    }
}
